<?php

Breadcrumbs::register('admin.auth.blogs.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.blogs.management'), route('admin.auth.blogs.index'));
});

Breadcrumbs::register('admin.auth.blogs.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.blogs.index');
    $breadcrumbs->push(__('menus.backend.access.blogs.create'), route('admin.auth.blogs.create'));
});

Breadcrumbs::register('admin.auth.blogs.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.blogs.index');
    $breadcrumbs->push(__('menus.backend.access.blogs.edit'), route('admin.auth.blogs.edit', $id));
});


Breadcrumbs::register('admin.auth.blogs.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.blogs.index');
    $breadcrumbs->push(__('menus.backend.access.blogs.show'), route('admin.auth.blogs.show', $id));
});