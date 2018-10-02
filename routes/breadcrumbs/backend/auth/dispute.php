<?php

Breadcrumbs::register('admin.auth.dispute.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.dispute.management'), route('admin.auth.dispute.index'));
});

Breadcrumbs::register('admin.auth.dispute.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.dispute.index');
    $breadcrumbs->push(__('menus.backend.access.dispute.create'), route('admin.auth.dispute.create'));
});

Breadcrumbs::register('admin.auth.dispute.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.dispute.index');
    $breadcrumbs->push(__('menus.backend.access.dispute.edit'), route('admin.auth.dispute.edit', $id));
});


Breadcrumbs::register('admin.auth.dispute.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.dispute.index');
    $breadcrumbs->push(__('menus.backend.access.dispute.show'), route('admin.auth.dispute.show', $id));
});