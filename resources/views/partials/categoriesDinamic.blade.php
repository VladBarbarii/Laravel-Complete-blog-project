<div class="list-group">
{{--        {{dd(App\Category::all())}}--}}
@foreach (App\Category::all() as $category)
        <a href="{{ route('showcate', $category)}}" class="list-group-item list-group-item-action list-group-item-dark">{{$category->name}}</a>
    @endforeach
</div>
