@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Single</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Multiple</a></li>
            </ul>

            <div class="tab-content mt-4">
                <div class="tab-pane active" id="tab_1">
                    <h3>Upload File Single</h3>
                    <form action="{{ route('image.storeSingle') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="form-control" name="ImageFile">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('image.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
                <div class="tab-pane" id="tab_2">
                    <h3>Upload File Multiple</h3>
                    <form action="{{ route('image.storeMultiple') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="ImageFile[]" id="" placeholder=""
                                aria-describedby="fileHelpId" multiple>
                            <small id="fileHelpId" class="form-text text-muted">Multiple Files</small>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('image.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
