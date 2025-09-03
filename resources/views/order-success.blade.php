@extends('website-layout.app')

@section('content')
    <style>
        .success-container {
            max-width: 800px;
            margin: 80px auto;
            padding: 40px 20px;
            text-align: center;
        }

        .success-icon {
            font-size: 80px;
            color: #27ae60;
            margin-bottom: 30px;
        }

        .success-title {
            font-size: 36px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .order-details {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            text-align: left;
        }

        .order-number {
            font-size: 24px;
            font-weight: 600;
            color: #35B4AD;
            margin-bottom: 20px;
            text-align: center;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #666;
        }

        .detail-value {
            color: #333;
            font-weight: 600;
        }

        .continue-shopping {
            display: inline-block;
            background: linear-gradient(135deg, #35B4AD 0%, #2a9089 100%);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .continue-shopping:hover {
            background: linear-gradient(135deg, #2a9089 0%, #35B4AD 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(53, 180, 173, 0.3);
            color: white;
            text-decoration: none;
        }

        .track-order {
            display: inline-block;
            background: transparent;
            color: #35B4AD;
            border: 2px solid #35B4AD;
            padding: 13px 40px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin: 0 10px;
        }

        .track-order:hover {
            background: #35B4AD;
            color: white;
            text-decoration: none;
        }
    </style>

    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1 class="success-title">Payment Successful!</h1>
        <p class="success-message">
            Thank you for your purchase. Your order has been confirmed and will be processed shortly.
            You will receive an email confirmation with your order details.
        </p>

        <div class="order-details">
            <div class="order-number">
                Order #{{ $order->id ?? 'N/A' }}
            </div>

            <div class="detail-row">
                <span class="detail-label">Payment ID:</span>
                <span class="detail-value">{{ $paymentIntent->id ?? 'N/A' }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Amount Paid:</span>
                <span class="detail-value">AED {{ number_format(($paymentIntent->amount ?? 0) / 100, 2) }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Payment Status:</span>
                <span class="detail-value" style="color: #27ae60;">{{ ucfirst($paymentIntent->status ?? 'completed') }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Order Date:</span>
                <span class="detail-value">{{ now()->format('F j, Y g:i A') }}</span>
            </div>

            @if(isset($order) && $order->customer_email)
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $order->customer_email }}</span>
            </div>
            @endif

            <div class="detail-row">
                <span class="detail-label">Estimated Delivery:</span>
                <span class="detail-value">{{ now()->addDays(3)->format('F j, Y') }}</span>
            </div>
        </div>

        <div style="margin-top: 40px;">
            <a href="{{ url('/') }}" class="continue-shopping">Continue Shopping</a>
            <a href="#" class="track-order">Track Order</a>
        </div>
    </div>
@endsection
