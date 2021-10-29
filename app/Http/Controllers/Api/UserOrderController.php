<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserOrder;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validated();
        $order = new UserOrder;
        $order->user_id = $request->input('user_id');
        $order->total_order_price = $request->input('total_order_price');
        $order->receipt_image = null;
        $order->status = 'pending';
        $order->save();


        // add loop for attach items to order
        foreach ($request->input('item') as $x => $val) {
            $total_item_price = $val['buyAmount'] * $val['price'];
            $order->items()->attach($val['id'], [
                'amount' => $val['buyAmount'],
                'total_item_price' => $total_item_price
            ]);
        }
        $order->save();
        $order->items;
        return $order;
        // get order with items from user
        // $user->find(2)->userOrders()->with('items')->get()
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserOrder(Request $request, $id)
    {
        if ($request->input('status') === 'all') {
            $orders = UserOrder::with('items')->where('user_id', $id)->orderby('created_at', 'DESC')->get();
        } else {
            $orders = UserOrder::with('items')->where('user_id', $id)->where('status', $request->input('status'))->orderby('created_at', 'DESC')->get();
        }
        return $orders;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $order = UserOrder::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
