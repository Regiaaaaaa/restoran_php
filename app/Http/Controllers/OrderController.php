<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Mengambil semua orders dengan relasi orderItems dan menu
        $orders = Order::with('orderItems.menu')->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Mengambil semua data menu
        $menus = Menu::all();

        return view('orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_items' => 'required|array',
            'order_items.*.menu_id' => 'required|exists:menus,id',
            'order_items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Hitung total harga
            $totalPrice = 0;
            foreach ($request->order_items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $totalPrice += $menu->price * $item['quantity'];
            }

            // Simpan data order
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'total_price' => $totalPrice,
                'order_date' => now(),
            ]);

            // Simpan item pesanan
            foreach ($request->order_items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                    'subtotal' => $menu->price * $item['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Failed to create order: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        // Memuat data order dengan relasi orderItems dan menu
        $order->load('orderItems.menu');

        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
