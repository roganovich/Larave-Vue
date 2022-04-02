@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('wikipages.index', $parent) }}

        <div class="row">
            <h1>{{ __('wikipages.index') }} {{ ($parent) ? $parent->title : '' }}</h1>

            <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
                <a class="btn btn-outline-primary" href="{{ route('wikipages.index') }}">
                    {{ __('default.all') }} <span class="badge bg-primary">{{ $total }}</span>
                </a>
                @foreach ($parentsFilter as $link)
                    <a class="btn btn-outline-primary" href="{{ route('wikipages.parent', ['id' => $link->id]) }}">
                        {{ $link->title }} <span class="badge bg-primary">{{ $link->count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row mt-2">
            @foreach ($items as $item)
                <div class="card col-md-4 col-lg-3 p-2">
                    <div class="card-body">
                        <h2 class="card-title"><a href="{{ route('wikipages.show', ['id' => $item->id]) }}"
                           class="">{{ $item->title }}</a>
                        </h2>
                        @if ($item->parent)
                                <a class="fw-bold text-success" href="{{ route('wikipages.parent', ['id' => $item->parent->id]) }}">
                                    {{ $item->parent->title }}
                                </a>
                        @endif
                        <p class="card-text">{!! $item->description !!}</p>
                        <div class=" position-absolute bottom-0 start-0 m-2">
                            {{ $item->created_at->format('d.m.Y') }}
                        </div>
                        <a href="{{ route('wikipages.show', ['id' => $item->id]) }}"
                           class="btn btn-primary position-absolute bottom-0 end-0 m-2">{{ __('default.follow') }}</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-2">
            {{ $items->links('pagination')}}
        </div>
    </div>
@endsection
