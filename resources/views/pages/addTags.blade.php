@extends('layout')

@section('content')
    <form method="post" action="{{ isset($tag)? route('tags.update', $tag): route('tags.store')}}">
        @csrf
        @isset($tag)
            @method('PATCH')
        @endisset
        <div class="container mt-5">
            <h2 class="my-3">{{(isset($tag))? 'Edit Tag': 'Add Tag'}}</h2>
            <hr>
            <div class="form-group mt-5">
                <label for="usr">Tag Name</label>
                <input type="text" name="name" class="form-control" id="usr" value="{{$tag->name ?? ''}}">
            </div>
            <button type="submit" class="btn btn-primary mt-3">{{(isset($tag))? 'Edit Tag': 'Add Tag'}}</button>
        </div>
    </form>
@stop