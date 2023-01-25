@extends('layouts.master')

@section('styles')
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <h6 class="card-title">Add New Post</h6>
        </div>
        <form role="form" method="post" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           id="title" placeholder="Enter Name">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title">Category</label>
                    <select name="category" class="form-control">
                        <option selected>Select Once</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="summernote">Description</label>
                    <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                              name="description" id="summernote" placeholder="Enter Description"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tags">Tag</label>
                    <select class="form-control js-tags @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple">
                        @foreach($tags as $tag)
                        <option value="{{ $tag }}">{{ $tag }}</option>
                        @endforeach
                    </select>
                    @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <img src="" id="image-preview" style="max-height: 150px;">
                <div class="mb-3">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                           id="image">
                    @error('image')
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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        //image upload preview
        $('#image').change(function () {
            let reader = new FileReader();

            reader.onload = (e) => {
                $('#image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0])
        })

        $(".js-tags").select2({
            tags: true
        });
    </script>

@endsection
