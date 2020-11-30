<?php

namespace App\Http\Controllers;

use App\Libraries\ImageLibrary;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ImageController extends Controller
{

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

        $data = new ImageLibrary();
        $data->save($request->file('ImageFile'));

        return redirect()->route('image.index')->with('message', 'Image has been save');
    }

    public function storeMultiple(Request $request)
    {
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
