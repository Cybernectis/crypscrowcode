<?php

Breadcrumbs::register('admin.auth.pages.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(__('menus.backend.access.pages.management'), route('admin.auth.pages.index'));
});

Breadcrumbs::register('admin.auth.pages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.auth.pages.index');
    $breadcrumbs->push(__('menus.backend.access.pages.create'), route('admin.auth.pages.create'));
});

Breadcrumbs::register('admin.auth.pages.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.pages.index');
    $breadcrumbs->push(__('menus.backend.access.pages.edit'), route('admin.auth.pages.edit', $id));
});
Breadcrumbs::register('admin.auth.section.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.auth.pages.index');
    $breadcrumbs->push(__('menus.backend.access.section.edit'), route('admin.auth.section.edit', $id));
});

Breadcrumbs::register('admin.auth.pages.show', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('admin.auth.pages.index');
    $breadcrumbs->push(__('menus.backend.access.pages.show'), route('admin.auth.pages.show', $page));
});