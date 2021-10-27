<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserOrder;
use App\Http\Controllers\Controller;

class OrderController extends Controller
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
        $validated = $request->validated();
        $order = new UserOrder();
        $order->status = 'pending';
        $order->user_id = $request->input('user_id');
        // add loop for attach items to order
        $order->save();
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
