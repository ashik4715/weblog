@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 mb-3">
            <div class="card mb-4 bg-dark shadow-sm">
                <div class="card-body">
                    <div class="author text-white">
                        <strong>Created By: {{ optional($post->user)->name }}</strong>
                        <strong class="float-right">Category: {{ optional($post->category)->title }}</strong>
                        <p>Created At: {{ $post->created_at->format('m/d/Y') }}</p>
                    </div>
                    <img class="card-img-top" src="{{ '/uploads/posts/'.$post->thumbnail }}" alt="">
                    <hr>
                    <div class="post-body text-white">
                        {!! $post->body !!}
                    </div>
                </div>
                <div class="card-footer bg-transparent border-t-2 border-gray-600">
                    <h4 class="text-white">Comments</h4>
                    <div class="">
                        <form action="{{ route('comment.save', $post->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="comment">Comment</label>
                                <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" cols="30" rows="3">{{ old('comment') }}</textarea>
                                @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <ul>
                        @forelse ($post->comments as $comment)
                        <li id="comment-1" class="rounded-lg bg-gray-200 bg-gray-700 p-4 my-4 relative group">
                            <div>
                                <a href="#/posts?author={{ $comment->user_id }}">
                                    <small class="opacity-75">@</small>{{ optional($comment->user)->name }}: <span class="float-end">{{ $comment->created_at->diffForHumans() }}</span>
                                </a>
                            </div>
                            <p class="ms-2 mt-2 ps-2 border-l-2 border-gray-300 border-gray-600">
                                {{ $comment->body }}
                            </p>
                        </li>
                        @empty
                            <li id="comment-1" class="rounded-lg bg-gray-200 bg-gray-700 p-4 my-4 relative group">
                                <div>
                                    Not Found!!
                                </div>
                                <p class="ms-2 mt-2 ps-2 border-l-2 border-gray-300 border-gray-600">
                                    Sorry! No comment found for this post.
                                </p>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
