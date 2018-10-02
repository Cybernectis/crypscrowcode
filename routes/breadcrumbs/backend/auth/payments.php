<?php

Breadcrumbs::register('admin.auth.payments.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.payments.management'), route('admin.auth.payments.index'));
});

Breadcrumbs::register('admin.auth.payments.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.payments.index');
    $breadcrumbs->push(__('menus.backend.access.payments.create'), route('admin.auth.payments.create'));
});

Breadcrumbs::register('admin.auth.payments.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.payments.index');
    $breadcrumbs->push(__('menus.backend.access.payments.edit'), route('admin.auth.payments.edit', $id));
});
