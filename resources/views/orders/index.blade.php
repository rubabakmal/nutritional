@extends('layouts.master')

@section('title', 'Orders')

@section('content')

    @include('components.notification')

    <div class="card mb-3 mb-md-4">
        <div class="card-body">
            <!-- Breadcrumb -->
            <nav class="d-none d-md-block" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Orders</div>
            </div>

            <!-- Search and Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('order.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search orders..."
                                   name="search" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="gd-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="btn-group" role="group">
                        <a href="{{ route('order.index') }}"
                           class="btn btn-outline-secondary {{ !request('status') ? 'active' : '' }}">All</a>
                        <a href="{{ route('order.index', ['status' => 'pending']) }}"
                           class="btn btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">Pending</a>
                        <a href="{{ route('order.index', ['status' => 'confirmed']) }}"
                           class="btn btn-outline-info {{ request('status') == 'confirmed' ? 'active' : '' }}">Confirmed</a>
                        <a href="{{ route('order.index', ['status' => 'processing']) }}"
                           class="btn btn-outline-primary {{ request('status') == 'processing' ? 'active' : '' }}">Processing</a>
                        <a href="{{ route('order.index', ['status' => 'shipped']) }}"
                           class="btn btn-outline-secondary {{ request('status') == 'shipped' ? 'active' : '' }}">Shipped</a>
                        <a href="{{ route('order.index', ['status' => 'delivered']) }}"
                           class="btn btn-outline-success {{ request('status') == 'delivered' ? 'active' : '' }}">Delivered</a>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive-xl">
                <table class="table text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th class="font-weight-semi-bold border-top-0 py-2">Order ID</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Customer</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Items</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Total</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Payment</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Date</th>
                            <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="py-3">
                                    <strong>#{{ $order->id }}</strong>
                                </td>
                                <td class="py-3">
                                    <div>
                                        <strong>{{ $order->shippingAddress->first_name ?? '' }} {{ $order->shippingAddress->last_name ?? '' }}</strong><br>
                                        <small class="text-muted">{{ $order->customer_email }}</small><br>
                                        <small class="text-muted">{{ $order->customer_phone }}</small>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge badge-light">{{ $order->items->count() }} item(s)</span>
                                </td>
                                <td class="py-3">
                                    <strong>{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</strong>
                                </td>
                                <td class="py-3">
                                    <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span><br>
                                    <small class="text-muted">{{ ucfirst($order->payment_method) }}</small>
                                </td>
                                <td class="py-3">
                                    <span class="badge badge-{{
                                        $order->order_status == 'delivered' ? 'success' :
                                        ($order->order_status == 'pending' ? 'warning' :
                                        ($order->order_status == 'cancelled' ? 'danger' : 'info'))
                                    }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div>
                                        {{ $order->created_at->format('M d, Y') }}<br>
                                        <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="position-relative">
                                        <a class="link-dark d-inline-block" href="{{ route('order.show', $order) }}" title="View Details">
                                            <i class="gd-eye icon-text"></i>
                                        </a>
                                        <div class="dropdown d-inline-block">
                                            <a class="link-dark" href="#" role="button" id="dropdownMenuLink{{ $order->id }}"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Update Status">
                                                <i class="gd-settings icon-text"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink{{ $order->id }}">
                                                <h6 class="dropdown-header">Update Status</h6>
                                                <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'pending')">Pending</a>
                                                <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'confirmed')">Confirmed</a>
                                                <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'processing')">Processing</a>
                                                <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'shipped')">Shipped</a>
                                                <a class="dropdown-item" href="#" onclick="updateOrderStatus({{ $order->id }}, 'delivered')">Delivered</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#" onclick="updateOrderStatus({{ $order->id }}, 'cancelled')">Cancel Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-3">
                                    <strong>No orders found</strong><br>
                                    <span class="text-muted">Orders will appear here once customers place them</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $orders->links('components.pagination') }}
            </div>
            <!-- End Orders Table -->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function updateOrderStatus(orderId, status) {
            Swal.fire({
                title: 'Update Order Status',
                text: `Change order #${orderId} status to "${status.toUpperCase()}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Updating...',
                        text: 'Please wait while we update the order status.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Make AJAX request
                    fetch("{{ route('order.update-status', ':id') }}".replace(':id', orderId), {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            order_status: status
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Order status updated successfully.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // Reload the page to reflect changes
                                location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Failed to update order status');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'Failed to update order status. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        }
    </script>
@endsection
