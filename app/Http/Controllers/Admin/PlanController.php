<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Auth;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('user_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $request->merge(['user_id' => Auth::guard('admin')->user()->id]);
        Plan::create($request->all());
        return redirect()->route('plans.index')->with('success', 'Plan created successfully!');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $plan->update($request->all());
        return redirect()->route('plans.index')->with('success', 'Plan updated successfully!');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully!');
    }
}
