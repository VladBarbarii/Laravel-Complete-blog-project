<div class="myDiv my-4 bg-light">
    <h1 class="mb-1"> Tags </h1>
    <hr>
{{--    {{dd(App\Tag::all())}}--}}
@foreach (App\Tag::all() as $tag)
        <a href="{{route('showtag', $tag)}}"><span class="badge badge-pill badge-primary">{{$tag->name}}</span></a>
    @endforeach

</div>
