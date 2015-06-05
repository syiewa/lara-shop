<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', '/backend');
});
Breadcrumbs::register('products', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Products', route('backend.product.index'));
});
Breadcrumbs::register('productcreate', function($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Create Product', route('backend.product.create'));
});
Breadcrumbs::register('productedit', function($breadcrumbs) {
    $breadcrumbs->parent('products');
    $breadcrumbs->push('Edit Product', route('backend.product.edit'));
});
Breadcrumbs::register('category', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Category', route('backend.category.index'));
});
Breadcrumbs::register('categorycreate', function($breadcrumbs) {
    $breadcrumbs->parent('category');
    $breadcrumbs->push('Create Category', route('backend.category.create'));
});
Breadcrumbs::register('categoryedit', function($breadcrumbs) {
    $breadcrumbs->parent('category');
    $breadcrumbs->push('Edit Category', route('backend.category.edit'));
});
Breadcrumbs::register('page', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Page', route('backend.page.index'));
});
Breadcrumbs::register('pagecreate', function($breadcrumbs) {
    $breadcrumbs->parent('page');
    $breadcrumbs->push('Create Page', route('backend.page.create'));
});
Breadcrumbs::register('pageedit', function($breadcrumbs) {
    $breadcrumbs->parent('page');
    $breadcrumbs->push('Edit Page', route('backend.page.edit'));
});
Breadcrumbs::register('user', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User', route('backend.user.index'));
});
Breadcrumbs::register('usercreate', function($breadcrumbs) {
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Create User', route('backend.user.create'));
});
Breadcrumbs::register('useredit', function($breadcrumbs) {
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Edit User', route('backend.user.edit'));
});
Breadcrumbs::register('rolecreate', function($breadcrumbs) {
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Create Role', route('backend.role.create'));
});
Breadcrumbs::register('roleedit', function($breadcrumbs) {
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Edit Role', route('backend.role.edit'));
});
Breadcrumbs::register('slideshow', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Slideshow', route('backend.slideshow.index'));
});
Breadcrumbs::register('slideshowcreate', function($breadcrumbs) {
    $breadcrumbs->parent('slideshow');
    $breadcrumbs->push('Create Slideshow', route('backend.slideshow.create'));
});
Breadcrumbs::register('slideshowedit', function($breadcrumbs) {
    $breadcrumbs->parent('slideshow');
    $breadcrumbs->push('Edit Slideshow', route('backend.slideshow.edit'));
});
Breadcrumbs::register('options', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Options', url('backend/options'));
});