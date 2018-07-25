<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\AttributeController;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/attributes', 'AttributeController');
    $router->resource('/attribute_sets', 'AttributeSetController');
    $router->resource('/products', 'ProductController');
    $router->resource('/fabrics', 'FabricController');
    $router->resource('/linings', 'LiningController');
    $router->resource('/styles', 'StyleController');
    $router->resource('/fabric_filter', 'FabricFilterController');

    // Sales
    $router->resource('/customers', 'CustomerController');
    $router->resource('/orders', 'OrderController');

});