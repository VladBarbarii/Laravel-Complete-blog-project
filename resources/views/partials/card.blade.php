

@forelse ($posts as $post)
    <div class="card mx-auto my-5">
        <img src="/storage/post_images/{{$post->image}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h4 class="card-title">Post name: {{$post->name}}</h4>
            {{--<p class="card-text">{{$post->content}}</p>--}}
            <h5>Categories: {{$post->category->name ?? '--'}}</h5>
            <h5>Tags:</h5>
            @foreach($post->tags as $tag)
                <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
            @endforeach
            <p class="card-text">Author: {{$post->user->name}}</p>
            <p class="card-text">Times viewed: {{$post->timesViewed}}</p>
            <a href="/posts/{{$post->id}}" class="btn my-3 btn-primary">View post</a>
            @auth
            @if(auth()->user()->isAdmin() or auth()->id()==$post->user_id)
                <a  href="{{route('posts.edit', $post)}}" class="btn btn-primary my-4 mx-3">Edit Post</a>
                <form method="post" action="{{route('posts.destroy', $post)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Do you really want to delete the form?')">Delete</button>
                     @endif
            @endauth
            </form>
    </div>
    </div>
@empty
        <div class="col my-5">
            There are no posts yet
        </div>
@endforelse

