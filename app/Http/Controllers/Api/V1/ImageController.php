<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Libraries\ImageLibrary;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index()
    {
        $data = Image::paginate(10);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ImageFile' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'meta' => [
                    'code' => 422,
                    'message' => 'Whoops'
                ],
                'result' => [
                    'error' => $validator->errors(),
                    'data' => []
                ]
            ], 422);
        }

        $data = new ImageLibrary();
        $data->save($request->file('ImageFile'));

        return response()->json([
            'meta' => [
                'code' => 201,
                'message' => 'Created'
            ],
            'result' => [
                'error' => [],
                'data' => $data
            ]
            ], 201);
    }
}
