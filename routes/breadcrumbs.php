<?php
/** Главная */
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('default.home'), route('home'));
});

/** Статьи */
Breadcrumbs::for('wikipages.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('wikipages.index'), route('wikipages.index'));
});

Breadcrumbs::for('wikipages.show', function ($trail, $item) {
    $trail->parent('home');
    $trail->push(__('wikipages.index'), route('wikipages.index'));

    if($item->tree){
        foreach ($item->tree as $parent) {
            $trail->push($parent->title, route('wikipages.show', ['id' => $parent->id]));
        }
    }

    $trail->push($item->title, route('wikipages.show', ['id' => $item->id]));
});

/** Подразделения */
Breadcrumbs::for('points.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('points.index'), route('points.index'));
});

Breadcrumbs::for('points.show', function ($trail, $item) {
    $trail->parent('home');
    $trail->push(__('points.index'), route('points.index'));

    if($item->type){
        $trail->push($item->type->title, route('points.index', ['type_id' => $item->type->id]));
    }

    $trail->push($item->title, route('points.show', ['id' => $item->id]));
});

/** Продукты */
Breadcrumbs::for('products.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('products.index'), route('products.index'));
});

Breadcrumbs::for('products.show', function ($trail, $item) {
    $trail->parent('home');
    $trail->push(__('products.index'), route('products.index'));

    if($item->brand){
        $trail->push($item->brand->title, route('products.index', ['brand' => $item->brand->slug]));
    }

    $trail->push($item->title, route('products.show', ['brand_slug'=>$item->brand->slug,'product_slug' => $item->slug]));
});
