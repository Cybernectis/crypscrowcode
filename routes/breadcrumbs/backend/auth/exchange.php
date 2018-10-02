<?php

Breadcrumbs::register('admin.auth.exchangerate.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.exchange.management'), route('admin.auth.exchangerate.index'));
});

Breadcrumbs::register('admin.auth.exchangerate.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.exchangerate.index');
    $breadcrumbs->push(__('menus.backend.access.exchange.create'), route('admin.auth.exchangerate.create'));
});

Breadcrumbs::register('admin.auth.exchangerate.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.exchangerate.index');
    $breadcrumbs->push(__('menus.backend.access.exchange.edit'), route('admin.auth.exchangerate.edit', $id));
});
