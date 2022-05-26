<form method="GET">
    <div class="mb-3">
        <label for="productBrand" class="form-label">{{ trans_choice('products.brand', 2) }}</label>
        <select name="Product[brand]" class="form-select" id="productBrand" aria-label="{{ trans_choice('products.brand', 2) }}">
            <option value="">{{ __('default.select') }}</option>
            @foreach ($brands as $link)
                <option
                    {{ (!empty($brand) && $brand->slug == $link->slug) ? 'selected' : '' }} value="{{ $link->slug }}">{{ $link->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="productCategory" class="form-label">{{ trans_choice('products.category', 2) }}</label>
        <select name="Product[category]" class="form-select" id="productCategory" aria-label="{{ trans_choice('products.brand', 2) }}">
            <option value="">{{ __('default.select') }}</option>
            @foreach ($caregories as $link)
                <option
                    {{ (!empty($category) && $category->slug == $link->slug) ? 'selected' : '' }} value="{{ $link->slug }}">{{ $link->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">{{ __('default.search') }}</button>
</form>

<hr>

<div class="btn-group d-inline p-0" role="group" aria-label="Basic example">
    <a class="btn btn-outline-dark btn-sm mt-1" href="{{ route('products.index') }}">
        {{ __('default.clear') }}
    </a>
</div>
