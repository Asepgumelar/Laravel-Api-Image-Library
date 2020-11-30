@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <img src="{{ url('storage/tmp/uploads/image/'. $data->name) }}" alt="{{ $data->name }}">
                <div class="form-group">
                    <label for="" class="text-capitalize">name</label> :{{ $data->name }}
                </div>
                <div class="form-group">
                    <label for="" class="text-capitalize">original name</label> :{{ $data->original_name }}
                </div>
                <div class="form-group">
                    <label for="" class="text-capitalize">extension</label> :{{ $data->extension }}
                </div>
                <div class="form-group">
                    <label for="" class="text-capitalize">path</label> :{{ $data->path }}
                </div>
                <div class="form-group">
                    <label for="" class="text-capitalize">image url</label> :{{ $data->image_url }}
                </div>
                <div class="form-group">
                    <label for="" class="text-capitalize">data type</label> :{{ $data->data_type }}
                </div>
            </div>
        </div>
    </div>
@endsection
