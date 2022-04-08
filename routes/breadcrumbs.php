<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('default.home'), route('home'));
});

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
