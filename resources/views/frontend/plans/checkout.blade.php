@extends('frontend.plans.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Plan Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-warning text-dark text-center py-4">
                        <h4 class="mb-0 fw-bold" style="color: #121212">{{ $plan->name }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">₹{{ $plan->price }}</h2>
                            <p class="text-muted mb-0">Get full access to the selected plan features.</p>
                        </div>

                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex align-items-center bg-light rounded mb-2">
                                <i class="bi bi-check2-circle text-warning me-3 fs-5"></i>
                                Access to selected features
                            </li>
                            <li class="list-group-item d-flex align-items-center bg-light rounded mb-2">
                                <i class="bi bi-check2-circle text-warning me-3 fs-5"></i>
                                Watermark-free playback
                            </li>
                            <li class="list-group-item d-flex align-items-center bg-light rounded mb-2">
                                <i class="bi bi-check2-circle text-warning me-3 fs-5"></i>
                                High-quality streaming
                            </li>
                            <li class="list-group-item d-flex align-items-center bg-light rounded">
                                <i class="bi bi-check2-circle text-warning me-3 fs-5"></i>
                                Priority support
                            </li>
                        </ul>

                        <!-- Razorpay Checkout Form -->
                        <form action="{{ route('plans.payment.complete') }}" method="POST" class="text-center">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="{{ $order->amount }}" data-currency="INR" data-order_id="{{ $order->id }}"
                                data-buttontext="Pay ₹{{ $plan->price }}" data-name="Your Company"
                                data-description="{{ $plan->name }}" data-prefill.name="{{ $user->name }}"
                                data-prefill.email="{{ $user->email }}" data-theme.color="#F37254">
                                </script>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-dark text-light py-3">
                        <small>Secure payments powered by Razorpay</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection