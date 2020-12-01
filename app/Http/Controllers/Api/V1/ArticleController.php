<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Libraries\ImageLibrary;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ImageFile' => 'required',
            'Name' => 'required',
            'Description' => 'required'
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
        if ($request->hasFile('ImageFile')) {
            $imgUrl = $request->file('ImageFile');
        }

        $article = new Article();
        $article->name = $request->Name;
        $article->description = $request->Description;
        $article->save();

        $image = new ImageLibrary();
        $image->save($imgUrl);

        return response()->json([
            'meta' => [
                'code' => 201,
                'message' => 'Created'
            ],
            'result' => [
                'error' => [],
                'data' => $article
            ]
        ], 201);
    }
}
