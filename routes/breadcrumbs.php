<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('default.home'), route('home'));
});

Breadcrumbs::for('wikipages.index', function ($trail, $parent = null) {
    $trail->parent('home');
    if(!empty($parent))
        $trail->push(__('wikipages.index'), route('wikipages.index'));
    $trail->push(__('wikipages.index'), route('wikipages.index'));
});

Breadcrumbs::for('wikipages.show', function ($trail, $item) {
    $trail->parent('home');
    $trail->push(__('wikipages.index'), route('wikipages.index'));
    if(isset($item->parent))
        $trail->push($item->parent->title, route('wikipages.parent', ['id' => $item->parent->id]));
    $trail->push($item->title, route('wikipages.show', ['id' => $item->id]));
});
