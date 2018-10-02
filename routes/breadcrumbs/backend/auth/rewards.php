<?php

Breadcrumbs::register('admin.auth.rewards.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.rewards.management'), route('admin.auth.rewards.index'));
});

Breadcrumbs::register('admin.auth.rewards.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.rewards.index');
    $breadcrumbs->push(__('menus.backend.access.rewards.create'), route('admin.auth.rewards.create'));
});

Breadcrumbs::register('admin.auth.rewards.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.rewards.index');
    $breadcrumbs->push(__('menus.backend.access.rewards.edit'), route('admin.auth.rewards.edit', $id));
});


Breadcrumbs::register('admin.auth.rewards.show', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('admin.auth.rewards.index');
    $breadcrumbs->push(__('menus.backend.access.rewards.show'), route('admin.auth.rewards.show', $page));
});
