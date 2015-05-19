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
