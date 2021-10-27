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
        $validated = $request->validated();
        $order = new RestockOrder();
        $order->status = 'pending';
        $order->supplier_id = $request->input('supplier_id');
        // add loop for attach items to order
        $order->save();
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
