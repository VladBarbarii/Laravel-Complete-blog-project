@extends('layout')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-8">
                @include('partials.card')
                <div class="my-5">
                    {!! $posts->links() !!}
                </div>
            </div>

            <div class="col-4 my-5">

                @include('partials.categoriesDinamic')
                @include('partials.tagsDinamic')
            </div>
        </div>
    </div>


{{--    @include('partials.errors')--}}

@stop
