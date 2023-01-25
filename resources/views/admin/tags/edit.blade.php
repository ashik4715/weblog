@extends('layouts.master')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <h6 class="card-title">Edit Tag #{{ $tag->id }}</h6>
        </div>
        <form role="form" method="post" action="{{ route('admin.tags.update', $tag->id) }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Tag Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ $category->title }}" id="title" placeholder="Enter Name">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
