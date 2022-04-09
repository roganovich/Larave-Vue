<div class="row">

    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        <a class="btn btn-outline-dark btn-sm mt-1 {{ (empty($parent)) ? 'active' : '' }}" href="{{ route('wikipages.index') }}">
            {{ __('default.all') }} <span class="badge bg-dark">{{ $total }}</span>
        </a>
        @foreach ($allParents as $link)
            <a class="btn btn-outline-primary btn-sm mt-1 {{ (!empty($parent) && $parent->id == $link->id) ? 'active' : '' }}" href="{{ route('wikipages.show', ['id' => $link->id]) }}">
                {{ $link->title }} <span class="badge bg-primary">{{ $link->count }}</span>
            </a>
        @endforeach
    </div>
</div>
