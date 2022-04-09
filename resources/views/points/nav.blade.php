    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        <a class="btn btn-outline-dark btn-sm mt-1  {{ (empty($city) && empty($type)) ? 'active' : '' }}" href="{{ route('points.index') }}">
            {{ __('default.all') }} <span class="badge bg-dark">{{ $total }}</span>
        </a>
    </div>

    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        @foreach ($types as $link)
            <a class="btn btn-outline-primary btn-sm mt-1 {{ (!empty($type) && $type->id == $link->id) ? 'active' : '' }}" href="{{ route('points.index', ['type' => $link->title]) }}">
                {{ $link->title }} <span class="badge bg-primary">{{ $link->count }}</span>
            </a>
        @endforeach
    </div>

    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        @foreach ($cityes as $link)
            <a class="btn btn-outline-success btn-sm mt-1 {{ (!empty($city) && $city == $link->title) ? 'active' : '' }}" href="{{ route('points.index', ['city' => $link->title]) }}">
                {{ $link->title }} <span class="badge bg-success">{{ $link->count }}</span>
            </a>
        @endforeach
    </div>

