<?php

namespace App\Http\Controllers;

use App\Libraries\ImageLibrary;
use App\Models\Image;
use CURLFile;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Unirest\Request\Body;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->client   = new Client();
        $this->base_url = env('APP_URL');
    }

    public function index()
    {
        $data = Image::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.image.index', compact('data'));
    }

    public function create()
    {
        return view('admin.image.create');
    }

    public function storeSingle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ImageFile' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if($request->hasFile('ImageFile')) {
            $file = $request->file('ImageFile');
        }
        $endpoint = '/api/v1/image/store';
        $baseUrl = $this->base_url . $endpoint;

        $output[]    = [
            'name'     => 'ImageFile',
            'contents' => fopen($file->getPathname(), 'r' ),
            'filename' => $file->getClientOriginalName()
        ];

        $response = $this->client->request( 'POST', $baseUrl, [
            'headers'   => [
                'Accept' => 'application/json'
            ],
            'multipart' => $output
        ]);

        if ($response->getStatusCode() == 201) {
            return redirect()->route('image.index')->with('message', 'Image has been uploaded');
        }
        return redirect()->route('image.index')->with('errors', 'Image error');

    }

    public function storeMultiple(Request $request)
    {
        //

        return redirect()->route('image.index');
    }

    public function show($id)
    {
        $data = Image::findOrfail($id);
        if (!$data) {
            return redirect()->route('image.index')->with('errors', 'Image not found');
        }
        return view('admin.image.show', compact('data'));
    }

    public function update(Request $request)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
