<?php

Breadcrumbs::register('admin.auth.stats.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.stats.management'), route('admin.auth.stats.index'));
});

Breadcrumbs::register('admin.auth.stats.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.stats.index');
    $breadcrumbs->push(__('menus.backend.access.stats.create'), route('admin.auth.stats.create'));
});

Breadcrumbs::register('admin.auth.stats.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.stats.index');
    $breadcrumbs->push(__('menus.backend.access.stats.edit'), route('admin.auth.stats.edit', $id));
});


Breadcrumbs::register('admin.auth.stats.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.stats.index');
    $breadcrumbs->push(__('menus.backend.access.stats.show'), route('admin.auth.stats.show', $id));
});