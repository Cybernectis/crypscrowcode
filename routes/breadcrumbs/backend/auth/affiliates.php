
<?php

Breadcrumbs::register('admin.auth.affiliates.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.affiliates.management'), route('admin.auth.affiliates.index'));
});

Breadcrumbs::register('admin.auth.affiliates.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.affiliates.index');
    $breadcrumbs->push(__('menus.backend.access.affiliates.create'), route('admin.auth.affiliates.create'));
});

Breadcrumbs::register('admin.auth.affiliates.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.affiliates.index');
    $breadcrumbs->push(__('menus.backend.access.affiliates.edit'), route('admin.auth.affiliates.edit', $id));
});
