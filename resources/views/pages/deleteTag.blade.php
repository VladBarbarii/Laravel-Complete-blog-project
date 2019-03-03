@extends('layout')
@section('content')

    <div class="container mt-5">
        <h2 class="my-3">Delete Tags</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nr.</th>
                <th scope="col">Tags</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($tags as $tag)
                <tr>
                    <th scope="row">1</th>
                    <td><h5>{{$tag->name}}</h5></td>
                    <td><form style="display: inline" method="post" action="/tags/{{$tag->id}}">
                            @csrf
                            @method('DELETE')
                            <button name="delete"  class="btn btn-danger my-4">Delete</button>
                        </form>
                        <a href="{{route('tags.edit', $tag)}}" class="btn btn-primary my-4">Edit</a>
                    </td>
                </tr>
            </tbody>

            @empty
                <div>No Categories to delete</div>
            @endforelse

        </table>
    </div>

@stop
