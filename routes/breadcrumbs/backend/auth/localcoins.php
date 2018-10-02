<?php

Breadcrumbs::register('admin.auth.localcoins.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.localcoins.management'), route('admin.auth.localcoins.index'));
});

Breadcrumbs::register('admin.auth.localcoins.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.localcoins.index');
    $breadcrumbs->push(__('menus.backend.access.localcoins.create'), route('admin.auth.localcoins.create'));
});

Breadcrumbs::register('admin.auth.localcoins.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.localcoins.index');
    $breadcrumbs->push(__('menus.backend.access.localcoins.edit'), route('admin.auth.localcoins.edit', $id));
});
