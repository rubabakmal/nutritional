<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with(['shippingAddress', 'items'])
                     ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('order_status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                  ->orWhere('customer_email', 'like', '%' . $search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $search . '%')
                  ->orWhereHas('shippingAddress', function($address) use ($search) {
                      $address->where('first_name', 'like', '%' . $search . '%')
                             ->orWhere('last_name', 'like', '%' . $search . '%');
                  });
            });
        }

        $orders = $query->paginate(20);

        // Get status counts for dashboard
        $statusCounts = [
            'pending' => Order::where('order_status', 'pending')->count(),
            'confirmed' => Order::where('order_status', 'confirmed')->count(),
            'processing' => Order::where('order_status', 'processing')->count(),
            'shipped' => Order::where('order_status', 'shipped')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
            'cancelled' => Order::where('order_status', 'cancelled')->count(),
        ];

        return view('orders.index', compact('orders', 'statusCounts'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load([
            'items.product',
            'shippingAddress',
            'billingAddress',
            'payments'
        ]);

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    // public function updateStatus(Request $request, Order $order)
    // {
    //     $request->validate([
    //         'order_status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
    //     ]);

    //     $order->update([
    //         'order_status' => $request->order_status
    //     ]);

    //     return redirect()->back()->with('success', 'Order status updated successfully');
    // }

    public function updateStatus(Request $request, Order $order)
{
    try {
        $request->validate([
            'order_status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'order_status' => $request->order_status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update order status: ' . $e->getMessage()
        ], 500);
    }
}
    /**
     * Get order status badge class
     */
    public function getStatusBadgeClass($status)
    {
        switch($status) {
            case 'pending': return 'warning';
            case 'confirmed': return 'info';
            case 'processing': return 'primary';
            case 'shipped': return 'secondary';
            case 'delivered': return 'success';
            case 'cancelled': return 'danger';
            default: return 'light';
        }
    }
}
