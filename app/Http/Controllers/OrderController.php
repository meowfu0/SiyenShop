<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\User;
use App\Mail\OrderStatusUpdate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index()
    {
        try {
            Log::info('Fetching shop orders for user ID: ' . auth()->id());

            $shop = Shop::where('user_id', auth()->id())->first();
            if (!$shop) {
                Log::warning('No shop found for user ID: ' . auth()->id());
                return response()->json(['error' => 'Shop not found'], 404);
            }

            $orders = Order::where('shop_id', $shop->id)->get();
            $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', $orders->pluck('id'))->get();
            $variant_item = ProductVariant::all();
            $categories = Category::all();
            $customer = User::whereIn('id', $orders->pluck('user_id'))->get();

            Log::info('Successfully fetched shop orders.');

            return view('livewire.shop.shop-orders', compact('orders', 'orderItems', 'variant_item', 'categories', 'shop', 'customer'));
        } catch (\Exception $e) {
            Log::error('Error fetching shop orders: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            Log::info('Updating order status.', $request->all());

            $validated = $request->validate([
                'currentCustomer' => 'required|integer',
                'order_id' => 'required|integer',
                'status_id' => 'required|integer',
                'denial_reason' => 'required|string',
                'denial_comment' => 'required|string'
            ]);

            $order = Order::find($validated['order_id']);
            if (!$order) {
                Log::warning('Order not found. Order ID: ' . $validated['order_id']);
                return response()->json(['error' => 'Order not found'], 404);
            }

            $shop = Shop::where('user_id', auth()->id())->first();
            $order->order_status_id = $validated['status_id'];
            $order->denial_reason = $validated['denial_reason'];
            $order->denial_comment = $validated['denial_comment'];
            $order->timestamps = false;
            $order->save();

            $id = $validated['currentCustomer'];
            $user = User::where('id', $id)->select('id', 'first_name', 'last_name', 'email')->first();
            $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', [$order->id])->get();
            $categories = $orderItems->map(function ($orderItem) {
                return Category::where('id', $orderItem->product->category_id)->first();
            });

            $variant_item = ProductVariant::all();

            Log::info('Sending email to customer.', ['email' => $user->email]);
            Mail::to($user->email)->send(new OrderStatusUpdate($user, $order, $orderItems, $categories, $shop, $variant_item));

            Log::info('Order status updated successfully.');

            return response()->json(['message' => 'Order status updated successfully']);
        } catch (\Exception $e) {
            Log::error('Error updating order status: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getOrders()
    {
        try {
            Log::info('Fetching orders for user ID: ' . auth()->id());

            $shop = Shop::where('user_id', auth()->id())->first();
            if (!$shop) {
                Log::warning('No shop found for user ID: ' . auth()->id());
                return response()->json(['error' => 'Shop not found'], 404);
            }

            $orders = Order::where('shop_id', $shop->id)->get();

            Log::info('Successfully fetched orders.');

            return response()->json($orders);
        } catch (\Exception $e) {
            Log::error('Error fetching orders: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function processDataTable(Request $request)
    {
        try {
            Log::info('Processing data table.', $request->all());

            $dataTable = $request->all();
            $htmlContent = view('livewire.shop.order-print-layout', ['dataTable' => $dataTable])->render();

            Log::info('Successfully processed data table.');

            return response()->json(['success' => true, 'htmlContent' => $htmlContent]);
        } catch (\Exception $e) {
            Log::error('Error processing data table: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
