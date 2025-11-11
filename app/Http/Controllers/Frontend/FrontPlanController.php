<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\UserPlan;
use Carbon\Carbon;
use Razorpay\Api\Api;
use App\Models\Transaction;
use Auth;
use App\Models\User;

class FrontPlanController extends Controller
{

    public function upgrade()
    {
        $plans = Plan::all();
        return view('frontend.plans.upgrade', compact('plans'));
    }

    public function upgradeSubmit($plan_id)
    {
        $user = Auth::guard('web')->user();
        $plan = Plan::findOrFail($plan_id);

        // 1️⃣ Check if user already has an active plan
        $existing = UserPlan::where('user_id', $user->id)
            ->whereDate('end_date', '>=', Carbon::now())
            ->first();

        if ($existing) {
            return redirect()->route('plans.upgrade')->with('error', 'You already have an active plan!');
        }

        // 2️⃣ Create Razorpay order
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'plan_receipt_' . uniqid(),
            'amount' => $plan->price * 100, // convert to paise
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);

        $transaction = Transaction::Create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'razorpay_order_id' => $order->id,
            'amount' => $plan->price,
            'currency' => 'INR',
            'status' => 'created',
        ]);

        // 3️⃣ Pass data to a checkout view
        return view('frontend.plans.checkout', [
            'order' => $order,
            'plan' => $plan,
            'user' => $user,
        ]);
    }

    public function completePayment(Request $request)
    {
        $user = Auth::guard('web')->user();
        $plan = Plan::findOrFail($request->plan_id);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // 1️⃣ Verify payment signature
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        $transaction = Transaction::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if ($transaction) {
            $transaction->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'status' => 'paid',
            ]);
        }

        try {
            $api->utility->verifyPaymentSignature($attributes);

            // 2️⃣ Save user plan after successful payment
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addDays($plan->duration_days ?? 30);

            UserPlan::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'status'  => 'active',
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            User::where('id', $user->id)->update([
                'plan_id' => $plan->id,
            ]);

            return redirect()->route('plans.upgrade')->with('success', 'Plan upgraded successfully!');
        } catch (\Exception $e) {

            $transaction->update(['status' => 'failed']);
            return redirect()->route('plans.upgrade')->with('error', 'Payment verification failed!');
        }
    }
}
