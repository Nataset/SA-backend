<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RestockOrder;
use App\Http\Controllers\Controller;

class RestockOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new RestockOrder();
        $order->status = 'pending';
        $order->supplier_id = $request->input('supplier_id');
        $order->ship_price = $request->input('ship_price');
        $order->total_restock_price = $request->input('total_restock_price');
        $order->save();

        $order->items()->attach($request->input('item_id'), [
            'amount' => $request->input('buyAmount'),
            'buyPrice' => $request->input('buyPrice'),
            'total_item_price' => $request->input('total_item_price')
        ]);
        $order->save();
        $order->items;
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function showRestockOrder(Request $request)
    {
        if ($request->input('status') === 'all') {
            $orders = RestockOrder::with('items')->with('supplier')->orderby('created_at', 'DESC')->get();
        } else {
            $orders = RestockOrder::with('items')->with('supplier')->where('status', $request->input('status'))->orderby('created_at', 'DESC')->get();
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
        $order = RestockOrder::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        $order->items[0]->amount += $order->items[0]->pivot->amount;
        $order->items[0]->save();
        $order->items;
        return response()->json([
            "status" => 'success',
            "data" => $order
        ]);
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
