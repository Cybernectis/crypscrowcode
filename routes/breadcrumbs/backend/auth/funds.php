<?php

Breadcrumbs::register('admin.auth.funds.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.funds.management'), route('admin.auth.funds.index'));
});

Breadcrumbs::register('admin.auth.funds.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.funds.index');
    $breadcrumbs->push(__('menus.backend.access.funds.create'), route('admin.auth.funds.create'));
});

Breadcrumbs::register('admin.auth.funds.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.funds.index');
    $breadcrumbs->push(__('menus.backend.access.funds.edit'), route('admin.auth.funds.edit', $id));
});
