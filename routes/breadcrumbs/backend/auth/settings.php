<?php

Breadcrumbs::register('admin.auth.settings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.settings.management'), route('admin.auth.settings.index'));
});

Breadcrumbs::register('admin.auth.settings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.settings.index');
    $breadcrumbs->push(__('menus.backend.access.settings.create'), route('admin.auth.settings.create'));
});

Breadcrumbs::register('admin.auth.settings.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.settings.index');
    $breadcrumbs->push(__('menus.backend.access.settings.edit'), route('admin.auth.settings.edit', $id));
});
