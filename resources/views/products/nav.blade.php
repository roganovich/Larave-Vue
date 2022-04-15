    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        <a class="btn btn-outline-dark btn-sm mt-1" href="{{ route('products.index') }}">
            {{ __('default.all') }} <span class="badge bg-dark">{{ $total }}</span>
        </a>
    </div>


    <div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
        @foreach ($brands as $link)
            <a class="btn btn-outline-primary btn-sm mt-1 {{ (!empty($brand) && $brand->slug == $link->slug) ? 'active' : '' }}" href="{{ route('products.index', ['brand' => $link->slug]) }}">
                {{ $link->title }} <span class="badge bg-primary">{{ $link->count }}</span>
            </a>
        @endforeach
    </div>
