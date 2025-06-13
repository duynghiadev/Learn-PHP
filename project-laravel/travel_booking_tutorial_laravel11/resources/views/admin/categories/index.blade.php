@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Categories</h3>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Created date</th>
                        <th scope="col">Updated date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $cate)
                        <tr>
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $cate->title }}</td>
                            <td><img height="120" width="120" src="{{ asset('uploads/categories/' . $cate->image) }}">
                            </td>
                            <td>{{ $cate->description }}</td>
                            <td>{{ $cate->slug }}</td>
                            <td>{{ $cate->created_at }}</td>
                            <td>{{ $cate->updated_at }}</td>
                            <td>
                                @if ($cate->status == 1)
                                    <span class="text text-success">Active</span>
                                @else
                                    <span class="text text-success">Unactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', [$cate->id]) }}" class="btn btn-warning">Edit</a>
                                <form onsubmit="return confirm('Bạn có muốn xóa không?');"
                                    action="{{ route('categories.destroy', [$cate->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Xóa">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>


@endsection
