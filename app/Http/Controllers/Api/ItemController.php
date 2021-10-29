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
        $item->save();
        // $myrequest = new UploadController();
        // $response = $myrequest->uploadBlock($request,  'backgroundImage', $item->id);
        // $detail = new ItemDetail();
        // $detail->item_id = $item->id;
        // $detail->name = $response->getData()->image_name;
        // $detail->image_path = $response->getData()->data;
        // $detail->save();

        session()->flash('message', $item->name . ' succesfully created');
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
        // foreach ($request->files as $key => $value) {
        //     # code...
        //     $upload = new UploadController();
        //     $res = $upload->uploadBlock($request, $key, $id);
        //     foreach ($item->itemDetails as $k => $v) {
        //         # code...
        //         if ($v->name === $key) {
        //             $v->image_path = $res->getData()->data;
        //             $v->save();
        //             break;
        //         }
        //     }
        // }

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
