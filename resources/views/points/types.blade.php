<div class="row">

    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        <a class="btn btn-outline-primary mt-1 {{ (empty($type)) ? 'active' : '' }}" href="{{ route('points.index') }}">
            {{ __('default.all') }} <span class="badge bg-primary">{{ $total }}</span>
        </a>
        @foreach ($items as $link)
            <a class="btn btn-outline-primary mt-1 {{ (!empty($type) && $type->id == $link->id) ? 'active' : '' }}" href="{{ route('points.index', ['type_id' => $link->id]) }}">
                {{ $link->title }} <span class="badge bg-primary">{{ $link->count }}</span>
            </a>
        @endforeach
    </div>
</div>
