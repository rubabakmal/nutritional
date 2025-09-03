@extends('layouts.master')

@section('title', 'Order #' . $order->id)

@section('content')

    @include('components.notification')

    <div class="card mb-3 mb-md-4">
        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->id }}</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3">
    <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">
        <i class="gd-arrow-left mr-2"></i>Back to Orders
    </a>
</div>
            <div class="mb-3 mb-md-4 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Order #{{ $order->id }}</h3>
                    <small class="text-muted">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</small>
                </div>
                <div>
                    <span class="badge badge-{{
                        $order->order_status == 'delivered' ? 'success' :
                        ($order->order_status == 'pending' ? 'warning' :
                        ($order->order_status == 'cancelled' ? 'danger' : 'info'))
                    }} p-2">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>

            <div class="row">
                <!-- Order Details -->
                <div class="col-lg-8 mb-4">
                    <!-- Order Items -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Order Items ({{ $order->items->count() }})</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->product_image)
                                                            <img src="{{ asset('storage/' . $item->product_image) }}"
                                                                 alt="{{ $item->product_name }}"
                                                                 class="rounded mr-3"
                                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded mr-3 d-flex align-items-center justify-content-center"
                                                                 style="width: 50px; height: 50px;">
                                                                <i class="gd-package text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <strong>{{ $item->product_name }}</strong>
                                                            @if($item->product_description)
                                                                <br><small class="text-muted">{{ $item->product_description }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->product_sku ?? 'N/A' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $order->currency }} {{ number_format($item->unit_price, 2) }}</td>
                                                <td><strong>{{ $order->currency }} {{ number_format($item->total_price, 2) }}</strong></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            @if($order->shippingAddress)
                                <address class="mb-0">
                                    <strong>{{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}</strong><br>
                                    {{ $order->shippingAddress->address_line_1 }}<br>
                                    @if($order->shippingAddress->address_line_2)
                                        {{ $order->shippingAddress->address_line_2 }}<br>
                                    @endif
                                    {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}<br>
                                    {{ $order->shippingAddress->country }}<br>
                                    <strong>Phone:</strong> {{ $order->shippingAddress->phone }}
                                </address>
                            @else
                                <p class="text-muted mb-0">No shipping address available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Payment Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                                    <p><strong>Payment Status:</strong>
                                        <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    @if($order->payment_intent_id)
                                        <p><strong>Payment Intent:</strong> {{ $order->payment_intent_id }}</p>
                                    @endif
                                    @if($order->payments->isNotEmpty())
                                        @foreach($order->payments as $payment)
                                            <p><strong>Transaction:</strong> {{ $payment->payment_intent_id ?? $payment->id }}</p>
                                            @if($payment->gateway_response && isset($payment->gateway_response['receipt_url']))
                                                <p><a href="{{ $payment->gateway_response['receipt_url'] }}" target="_blank" class="btn btn-sm btn-outline-primary">View Receipt</a></p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-4">
                    <!-- Order Summary -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>{{ $order->currency }} {{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>{{ $order->shipping_cost > 0 ? $order->currency . ' ' . number_format($order->shipping_cost, 2) : 'FREE' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (5%):</span>
                                <span>{{ $order->currency }} {{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong>{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                            <p><strong>Customer Since:</strong> {{ $order->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                    <!-- Order Status Update -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Update Status</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('order.update-status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="order_status">Order Status</label>
                                    <select name="order_status" id="order_status" class="form-control">
                                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
