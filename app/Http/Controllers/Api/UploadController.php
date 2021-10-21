<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class UploadController extends Controller
{


    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => 'fail', "error" => $validator->errors()->all()], 400);
        }
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $imagePath = 'images/'.$imageName;

        return response()->json([
            'status' => 'success',
            'imagePath' => $imagePath
        ], 200);
    }
}
