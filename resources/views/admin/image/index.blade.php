@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Great!</strong> {{ session('message') }}
    </div>
    @endif
    @if (session('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Whoops!</strong> {{ session('message') }}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <a href="{{ route('image.create') }}" class="btn btn-primary">Create</a>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Original Name</th>
                            <th>Extension</th>
                            <th>Path</th>
                            <th>Image Url</th>
                            <th>Data Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key =>$item)
                        <tr>
                            <td>
                                {{ $key + 1}}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->original_name }}
                            </td>
                            <td>
                                {{ $item->extension }}
                            </td>
                            <td>
                                {{ $item->path }}
                            </td>
                            <td>
                                {{ $item->image_url }}
                            </td>
                            <td>
                                {{ $item->data_type }}
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                                <a href="{{ route('image.show', $item->id) }}" class="btn btn-sm btn-primary">Show</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Empty
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- {{ $data->links() }} --}}
        </div>
    </div>
</div>
@endsection
