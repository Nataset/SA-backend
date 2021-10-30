<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();
        return $items;
    }
    public function getItemById($id)
    {
        $item = Item::findOrFail($id);
        $item->suppliers;
        return $item;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->input('name');
        $item->amount = $request->input('amount');
        $item->price = $request->input('price');
        $item->min_item = $request->input('min_item');
        $item->image_path = $request->input('image');
        $item->save();

        foreach ($request->input('suppliers') as $key => $val) {
            $item->suppliers()->attach($val['id']);
        }
        $item->save();
        $item->suppliers;

        return $item;
    }

    public function addSupplierToItem(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->suppliers()->attach($request->input('supplier_id'));
        $item->save();
        $item = Item::with('suppliers')->find($id);
        return $item;
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

    public function showItemSupplier($id)
    {
        $supplier = Supplier::whereHas('items', function ($q) use ($id) {
            $q->where('item_id', $id);
        })->get();
        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->name = $request->input('name');
        $item->amount = $request->input('amount');
        $item->price = $request->input('price');
        $item->min_item = $request->input('min_item');
        $item->save();

        $item->suppliers()->detach();
        foreach ($request->input('selectSuppliers') as $val) {
            $item->suppliers()->attach($val['id']);
        }
        $item->save();

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
    }
}
