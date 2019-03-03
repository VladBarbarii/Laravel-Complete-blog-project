@extends('layout')

@section('content')
    <form method="post" action="{{ isset($category)? route('categories.update', $category): route('categories.store')}}">
        @csrf
        @isset($category)
            @method('PATCH')
        @endisset
        <div class="container mt-5">
            <h2 class="my-3">{{(isset($category))? 'Edit Category': 'Add Category'}}</h2>
            <hr>
            <div class="form-group mt-5">
                <label for="usr">Category Name</label>
                <input type="text" name="name" class="form-control" id="usr" value="{{$category->name ?? ''}}">
            </div>
            <button type="submit" class="btn btn-primary mt-3">{{(isset($category))? 'Edit Category': 'Add Category'}}</button>
        </div>
    </form>
@stop