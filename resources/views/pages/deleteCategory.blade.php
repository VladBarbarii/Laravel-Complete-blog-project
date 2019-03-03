@extends('layout')
@section('content')

    <div class="container mt-5">
        <h2 class="my-3">Delete Categories</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Nr.</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <th scope="row">1</th>
                    <td><h5>{{$category->name}}</h5></td>
                    <td><form method="post" style="display: inline" action="{{ route('categories.destroy', $category) }}">
                        @csrf
                        @method('DELETE')
                            <button name="delete" class="btn btn-danger my-4">Delete</button>
                        </form>
                            <a href="{{route('categories.edit', $category)}}" class="btn btn-primary my-4">Edit</a>
                    </td>
                </tr>
            </tbody>

                @empty
                    <div>No Categories to delete</div>
    @endforelse

    </table>
    </div>

@stop


