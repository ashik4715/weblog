@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title float-start">Tag List</h6>
            <div class="card-title float-end btn btn-primary">
                <a href="{{ route('admin.tags.create') }}" class="text-white">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th style="width: 40px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->title }}</td>
                        <td>{{ $tag->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('admin.tags.edit', $tag->id) }}">
                                <span class="badge bg-primary">Edit</span>
                            </a>
                            <form id="delete-form-{{ $tag->id }}" method="post"
                                  action="{{ route('admin.tags.delete', $tag->id) }}" style="display: none">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                            </form>
                            <a href="" class="badge bg-danger text-white" onclick="
                                if(confirm('Are you sure, You want to Delete this ??'))
                                {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $tag->id }}').submit();
                                }
                                else {
                                event.preventDefault();
                                }">Delete
                            </a>
                            {{--<span class="badge bg-danger">Delete</span>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $tags->links() }}
        </div>
    </div>
@endsection
