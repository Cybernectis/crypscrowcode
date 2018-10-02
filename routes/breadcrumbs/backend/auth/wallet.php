<?php

Breadcrumbs::register('admin.auth.wallet.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.wallet.management'), route('admin.auth.wallet.index'));
});

Breadcrumbs::register('admin.auth.wallet.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.wallet.index');
    $breadcrumbs->push(__('menus.backend.access.wallet.create'), route('admin.auth.wallet.create'));
});

Breadcrumbs::register('admin.auth.wallet.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.wallet.index');
    $breadcrumbs->push(__('menus.backend.access.wallet.edit'), route('admin.auth.wallet.edit', $id));
});
