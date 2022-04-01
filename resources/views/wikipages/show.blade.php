@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('wikipages.show', $item) }}

        <div class="row justify-content-center">
            <h1>{{ $item->title }}</h1>
                <div class="card col-md-12 col-lg-12 p-2">
                    <div class="card-body">
                        <h3 class="card-title">{{ ($item->parent)?$item->parent->title:'' }}</h3>
                        <p class="card-text">{!! $item->description !!}</p>
                    </div>
                </div>


        </div>
    </div>
@endsection
