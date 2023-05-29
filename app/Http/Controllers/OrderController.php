<?php

namespace App\Http\Controllers;

use App\Jobs\OrderJob;
use App\Jobs\UpdateWalletJob;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->paginate(10);

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:2|max:1000',
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
        ]);
        $order->save();
        dispatch(new UpdateWalletJob($request->all(), $order));
        return response()->json([
            'message' => 'Order created successfully, please wait for the payment to be processed.',
            'data' => $order,
            'status' => 0, // pending
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $order_id)
    {
        $order = Order::with('user')->where('order_id', $order_id)->first();

        return response()->json([
            'data' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
