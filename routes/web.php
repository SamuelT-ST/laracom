<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */

Route::get('/test', function (){

    dd(Auth::guard('employee')->user());

    dd(Auth::guard('employee')->user()->can('admin'));

    dd(app()->getLocale());
    app('rinvex.categories.category')->create(['name' => 'Home', 'slug' => 'home']);;
});


Route::middleware('employee')->group(function () {
    Route::namespace('Admin\Overrides')->group(function () {
        Route::post('upload',                   'ModifiedFileUploadController@upload')->name('brackets/media::upload');
        Route::get('view',                      'ModifiedFileViewController@view')->name('brackets/media::view');
    });
});


Route::namespace('Admin')->group(function () {
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login')->name('admin.login');
    Route::get('admin/logout', 'LoginController@logout')->name('admin.logout');
});
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.' ], function () {

    Route::namespace('Admin')->group(function () {
        Route::group(['middleware' => ['role:admin|superadmin|clerk, guard:employee']], function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::namespace('Products')->group(function () {
                Route::resource('products', 'ProductController')->except('update');
                Route::post('products/{product}', 'ProductController@update')->name('products.update');
                Route::get('remove-image-product', 'ProductController@removeImage')->name('product.remove.image');
                Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb');
            });
            Route::namespace('Customers')->group(function () {
                Route::resource('customers', 'CustomerController')->except('update');
                Route::post('customers/{customer}', 'CustomerController@update')->name('customers.update');
                Route::resource('customers.addresses', 'CustomerAddressController');

            });
            Route::namespace('Categories')->group(function () {
                Route::resource('categories', 'CategoryController')->except(['index', 'show', 'update'], 'create');
                Route::get('categories/create/{category?}', 'CategoryController@create')->name('categories.create');
                Route::get('categories/{categories?}', 'CategoryController@index')
                    ->where('categories','^[a-zA-Z0-9-_\/]+$')
                    ->name('categories.index');
                Route::post('categories/{category}', 'CategoryController@update')->name('categories.update');
                Route::get('remove-image-category', 'CategoryController@removeImage')->name('category.remove.image');
            });
            Route::namespace('Orders')->group(function () {
                Route::resource('orders', 'OrderController');
                Route::resource('order-statuses', 'OrderStatusController')->except('update');
                Route::post('order-statuses/{order_status}', 'OrderStatusController@update')->name('order-statuses.update');
                Route::get('orders/{id}/invoice', 'OrderController@generateInvoice')->name('orders.invoice.generate');
            });
            Route::resource('addresses', 'Addresses\AddressController')->except('update');
            Route::post('addresses/{address}', 'Addresses\AddressController@update')->name('addresses.update');
            Route::resource('customerGroups', 'CustomerGroups\CustomerGroupsController')->except('update');
            Route::post('customerGroups/{customerGroup}', 'CustomerGroups\CustomerGroupsController@update')->name('customerGroups.update');
            Route::resource('countries', 'Countries\CountryController');
            Route::resource('countries.provinces', 'Provinces\ProvinceController');
            Route::resource('countries.provinces.cities', 'Cities\CityController');
            Route::resource('couriers', 'Couriers\CourierController')->except('update');
            Route::post('couriers/{courier}', 'Couriers\CourierController@update')->name('couriers.update');
            Route::resource('attributes', 'Attributes\AttributeController')->except('update');
            Route::post('attributes/{attribute}', 'Attributes\AttributeController@update')->name('attributes.update');
            Route::resource('attributes.values', 'Attributes\AttributeValueController');
            Route::resource('brands', 'Brands\BrandController');

        });
        Route::group(['middleware' => ['role:admin|superadmin, guard:employee']], function () {
            Route::resource('employees', 'EmployeeController');
            Route::get('employees/{id}/profile', 'EmployeeController@getProfile')->name('employee.profile');
            Route::put('employees/{id}/profile', 'EmployeeController@updateProfile')->name('employee.profile.update');
            Route::resource('roles', 'Roles\RoleController');
            Route::resource('permissions', 'Permissions\PermissionController');
        });
    });
});

/**
 * Frontend routes
 */
Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('cart/login', 'CartLoginController@showLoginForm')->name('cart.login');
    Route::post('cart/login', 'CartLoginController@login')->name('cart.login');
    Route::get('logout', 'LoginController@logout');
});

Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['middleware' => ['auth', 'web']], function () {

        Route::namespace('Payments')->group(function () {
            Route::get('bank-transfer', 'BankTransferController@index')->name('bank-transfer.index');
            Route::post('bank-transfer', 'BankTransferController@store')->name('bank-transfer.store');
        });

        Route::namespace('Addresses')->group(function () {
            Route::resource('country.state', 'CountryStateController');
            Route::resource('state.city', 'StateCityController');
        });

        Route::get('accounts', 'AccountsController@index')->name('accounts');
        Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
        Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
        Route::get('checkout/execute', 'CheckoutController@executePayPalPayment')->name('checkout.execute');
        Route::post('checkout/execute', 'CheckoutController@charge')->name('checkout.execute');
        Route::get('checkout/cancel', 'CheckoutController@cancel')->name('checkout.cancel');
        Route::get('checkout/success', 'CheckoutController@success')->name('checkout.success');
        Route::resource('customer.address', 'CustomerAddressController');
    });
    Route::resource('cart', 'CartController');
    Route::get("category/{slug}", 'CategoryController@getCategory')->name('front.category.slug');
    Route::get("search", 'ProductController@search')->name('search.product');
    Route::get("{product}", 'ProductController@show')->name('front.get.product');
});