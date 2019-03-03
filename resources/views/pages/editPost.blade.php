@extends('layout')
@section('content')
    <form method="post" action="{{route('posts.update', $post)}}" enctype="multipart form-data">
        @method('PATCH')

        <div class="container mt-5">
            <h3 class="my-3">Edit post data:</h3>
            <hr>
            <div class="form-group mt-5">
                <label for="usr">Edit post Name</label>
                <input type="text" name="name" class="form-control" value="{{$post->name}}" id="usr">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Edit categories</label>
                <select  name="category" class="form-control" id="exampleFormControlSelect2">
                @foreach (App\Category::all() as $category)

                    <option value="{{$category->id}} "> {{$category->name}}</option>
                    @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Select by tag</label>
                <select multiple name="tags[]" class="form-control" id="exampleFormControlSelect2">
                    @foreach (App\Tag::all() as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Edit Content</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3">{{$post->content}}</textarea>
            </div>
            <div class="form-group mt-5">
                <label for="usr">Edit image title</label>
                <input type="text" name="imageTitle" value="{{$post->imagheTitle}}" class="form-control" id="usr">
            </div>
                 <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Alege imaginea</label>
                 </div>
            <button type="submit" class="btn btn-primary my-4">Edit</button>
        </div>
    </form>

@stop
