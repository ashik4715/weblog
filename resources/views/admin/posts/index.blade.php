@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title float-start">Post List</h6>
            <div class="card-title float-end btn btn-primary btn-sm">
                <a href="{{ route('admin.posts.create') }}" class="text-white">Add New</a>
            </div>
        </div>
        @if(session('message'))
            <div class="bg-success">{{ session('message') }}</div>
    @endif
    <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>CreatedBy</th>
                    <th>Created At</th>
                    <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ 'uploads/posts/'.$post->thumbnail }}"
                                 style="width: 50px; height: 50px"></td>
                        <td>{{ $post->category->title }}</td>
                        <td>{{ strip_tags($post->description) }}</td>
                        <td>{{ optional($post->user)->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}">
                                <span class="badge bg-primary">Edit</span>
                            </a>
                            <form id="delete-form-{{ $post->id }}" method="post"
                                  action="{{ route('admin.posts.destroy', $post->id) }}" style="display: none">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                            </form>
                            <a href="" class="badge bg-danger text-white" onclick="
                                if(confirm('Are you sure, You want to Delete this ??'))
                                {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $post->id }}').submit();
                                }
                                else {
                                event.preventDefault();
                                }">Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
