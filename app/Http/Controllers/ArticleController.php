<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::paginate(10);
        return view('admin.article.index');
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ImageFile' => 'required',
            'Name' => 'required',
            'Description' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if($request->hasFile('ImageFile')) {
            $file = $request->file('ImageFile');
        }
        $endpoint = '/api/v1/article/store';
        $baseUrl = $this->base_url . $endpoint;

        $response = $this->client->request( 'POST', $baseUrl, [
            'headers'   => [
                'Accept' => 'application/json'
            ],
            'multipart' => [
                [
                    'name' => 'Name',
                    'contents' => $request->Name,
                ],
                [
                    'name' => 'Description',
                    'contents' => $request->Description,
                ],
                [
                    'name'     => 'ImageFile',
                    'contents' => fopen($file->getPathname(), 'r' ),
                    'filename' => $file->getClientOriginalName()
                ]
            ]
        ]);

        if ($response->getStatusCode() == 201) {
            return redirect()->route('article.index')->with('message', 'Article has been uploaded');
        }
        return redirect()->route('article.index')->with('errors', 'Article error');
    }
}
