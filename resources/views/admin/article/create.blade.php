@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Create New Article</h3>
            <form action="{{ route('image.storeSingle') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Image</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" name="ImageFile">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="Name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" name="Description" id="" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('image.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
