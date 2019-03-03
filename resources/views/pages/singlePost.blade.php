@extends('layout')
@section('content')
    <div class="container">

    <div class="col my-5">
        <div class="card mx-auto">
            <img src="/storage/post_images/{{$post->image}}" class="card-img-top" alt="{{ $post->imageTitle  }}">
            <div class="card-body">
                <h5 class="card-title">Denumirea postului: {{$post->name}}</h5>
                <hr>
                <h5 class="card-text">Content: </h5>
                <div class="mb-4">{{$post->content}}</div>
                <hr>
                <p class="card-text">Category: {{$post->category->name}}</p>
                <hr>
                <p class="card-text">Created By: {{$post->user->name}}</p>
                <hr>
                <p class="card-text">Times viewed: {{$post->timesViewed}}</p>
                <hr>

                <p class="card-text">Creation date: {{$post->created_at}}</p>
                <hr>
                <h4 class="card-text">Tags: </h4>
                @foreach ($tags=$post->tags as $tag)
                    <p>{{$tag['name']}}</p>
                @endforeach
            </div>

        </div>
        <a class="btn btn-dark my-4" href="/">Go back</a>
    </div>
    </div>
@stop
