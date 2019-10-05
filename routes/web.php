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

Route::get('/test', function(){
    dd(Auth::guard('web')->user());
})->name('dashboard');


Route::group(['prefix' => 'admin', 'middleware' => ['auth:' . config('admin-auth.defaults.guard'), 'admin'], 'as' => 'admin.' ], function () {

    Route::namespace('Admin')->group(function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::namespace('Products')->group(function () {
                Route::get('products/ajaxFindProduct/{query?}',      'ProductController@ajaxFindProduct')->name('ajaxFindProduct');
                Route::resource('products', 'ProductController')->except('update');
                Route::post('products/{product}', 'ProductController@update')->name('products.update');
                Route::get('remove-image-product', 'ProductController@removeImage')->name('product.remove.image');
                Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb');
            });
            Route::namespace('Customers')->group(function () {
                Route::get('customer/{customer}/address','CustomerAddressController@getAvailableAddresses')->name('addresses.getAvailable');
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
                Route::resource('order-statuses', 'OrderStatusController')->except('update');
                Route::post('order-statuses/{order_status}', 'OrderStatusController@update')->name('order-statuses.update');
//                Route::get('orders/{id}/invoice', 'OrderController@generateInvoice')->name('orders.invoice.generate');
            });
            Route::resource('addresses', 'Addresses\AddressController')->except('update');
            Route::post('addresses/{address}', 'Addresses\AddressController@update')->name('addresses.update');
            Route::resource('customerGroups', 'CustomerGroups\CustomerGroupsController')->except('update');
            Route::post('customerGroups/{customerGroup}', 'CustomerGroups\CustomerGroupsController@update')->name('customerGroups.update');
            Route::resource('countries', 'Countries\CountryController');
            Route::resource('attributes', 'Attributes\AttributeController')->except('update');
            Route::post('attributes/{attribute}', 'Attributes\AttributeController@update')->name('attributes.update');
            Route::resource('attributes.values', 'Attributes\AttributeValueController');
            Route::resource('brands', 'Brands\BrandController');

            Route::get('discounts',                              'Discounts\DiscountsController@index');
            Route::get('discounts/create',                       'Discounts\DiscountsController@create');
            Route::post('discounts',                             'Discounts\DiscountsController@store');
            Route::get('discounts/{discount}/edit',              'Discounts\DiscountsController@edit')->name('admin/discounts/edit');
            Route::post('discounts/{discount}',                  'Discounts\DiscountsController@update')->name('admin/discounts/update');
            Route::delete('discounts/{discount}',                'Discounts\DiscountsController@destroy')->name('admin/discounts/destroy');
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
    Route::post('cart/mass-update', 'CartController@massUpdate');
    Route::post('cart/store-group', 'CartController@storeGroup')->name('store-group');
    Route::get('cart/checkout', 'CartController@checkout')->name('checkout');
    Route::post('cart/checkout', 'CartController@storeOrder')->name('storeOrder');
    Route::resource('cart', 'CartController');
//    Route::post('cart/mass-update', function(){
//        dd('test');
//    });
    Route::get("category/{hierarchy}", 'CategoryController@getCategory')->where('hierarchy','^[a-zA-Z0-9-_\/]+$')->name('front.category.slug');
    Route::get("search", 'ProductController@search')->name('search.product');
    Route::get("{product}", 'ProductController@show')->name('front.get.product');
    Route::get("product-group/{slug}", 'ProductController@showProductGroup')->name('front.product-group');

});

/* Auto-generated admin routes */

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/admin-users',                            'Admin\AdminUsersController@index');
    Route::get('/admin/admin-users/create',                     'Admin\AdminUsersController@create');
    Route::post('/admin/admin-users',                           'Admin\AdminUsersController@store');
    Route::get('/admin/admin-users/{adminUser}/edit',           'Admin\AdminUsersController@edit')->name('admin/admin-users/edit');
    Route::post('/admin/admin-users/{adminUser}',               'Admin\AdminUsersController@update')->name('admin/admin-users/update');
    Route::delete('/admin/admin-users/{adminUser}',             'Admin\AdminUsersController@destroy')->name('admin/admin-users/destroy');
    Route::get('/admin/admin-users/{adminUser}/resend-activation','Admin\AdminUsersController@resendActivationEmail')->name('admin/admin-users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/profile',                                'Admin\ProfileController@editProfile');
    Route::post('/admin/profile',                               'Admin\ProfileController@updateProfile');
    Route::get('/admin/password',                               'Admin\ProfileController@editPassword');
    Route::post('/admin/password',                              'Admin\ProfileController@updatePassword');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/orders',                                 'Admin\Orders\OrdersController@index')->name('admin.orders.index');
    Route::get('/admin/orders/create',                          'Admin\Orders\OrdersController@create')->name('admin.orders.create');
    Route::post('/admin/orders',                                'Admin\Orders\OrdersController@store');
    Route::get('/admin/orders/{order}/edit',                    'Admin\Orders\OrdersController@edit')->name('admin/orders/edit');
    Route::post('/admin/orders/{order}',                        'Admin\Orders\OrdersController@update')->name('admin/orders/update');
    Route::delete('/admin/orders/{order}',                      'Admin\Orders\OrdersController@destroy')->name('admin/orders/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/payment-methods',                        'Admin\PaymentMethods\PaymentMethodsController@index');
    Route::get('/admin/payment-methods/create',                 'Admin\PaymentMethods\PaymentMethodsController@create');
    Route::post('/admin/payment-methods',                       'Admin\PaymentMethods\PaymentMethodsController@store');
    Route::get('/admin/payment-methods/{paymentMethod}/edit',   'Admin\PaymentMethods\PaymentMethodsController@edit')->name('admin/payment-methods/edit');
    Route::post('/admin/payment-methods/{paymentMethod}',       'Admin\PaymentMethods\PaymentMethodsController@update')->name('admin/payment-methods/update');
    Route::delete('/admin/payment-methods/{paymentMethod}',     'Admin\PaymentMethods\PaymentMethodsController@destroy')->name('admin/payment-methods/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/settings',                               'Admin\SettingsController@index');
    Route::get('/admin/settings/create',                        'Admin\SettingsController@create');
    Route::post('/admin/settings',                              'Admin\SettingsController@store');
    Route::get('/admin/settings/{setting}/edit',                'Admin\SettingsController@edit')->name('admin/settings/edit');
    Route::post('/admin/settings/{setting}',                    'Admin\SettingsController@update')->name('admin/settings/update');
    Route::delete('/admin/settings/{setting}',                  'Admin\SettingsController@destroy')->name('admin/settings/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::post('/admin/features/create',                        'Admin\Features\FeaturesController@create');
    Route::post('/admin/features/createValue',                        'Admin\Features\FeaturesController@createValue');
    Route::get('/admin/features/loadFeatureValues/{feature}',             'Admin\Features\FeaturesController@loadFeatureValues');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/couriers',                               'Admin\Couriers\CouriersController@index')->name('admin.couriers.index');
    Route::get('/admin/couriers/create',                        'Admin\Couriers\CouriersController@create');
    Route::post('/admin/couriers',                              'Admin\Couriers\CouriersController@store');
    Route::get('/admin/couriers/{courier}/edit',                'Admin\Couriers\CouriersController@edit')->name('admin/couriers/edit');
    Route::post('/admin/couriers/bulk-destroy',                 'Admin\Couriers\CouriersController@bulkDestroy')->name('admin/couriers/bulk-destroy');
    Route::post('/admin/couriers/{courier}',                    'Admin\Couriers\CouriersController@update')->name('admin/couriers/update');
    Route::delete('/admin/couriers/{courier}',                  'Admin\Couriers\CouriersController@destroy')->name('admin/couriers/destroy');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/product-groups',                         'Admin\ProductGroups\ProductGroupsController@index');
    Route::get('/admin/product-groups/create',                  'Admin\ProductGroups\ProductGroupsController@create');
    Route::post('/admin/product-groups',                        'Admin\ProductGroups\ProductGroupsController@store');
    Route::get('/admin/product-groups/{productGroup}/edit',     'Admin\ProductGroups\ProductGroupsController@edit')->name('admin/product-groups/edit');
    Route::post('/admin/product-groups/bulk-destroy',           'Admin\ProductGroups\ProductGroupsController@bulkDestroy')->name('admin/product-groups/bulk-destroy');
    Route::post('/admin/product-groups/{productGroup}',         'Admin\ProductGroups\ProductGroupsController@update')->name('admin/product-groups/update');
    Route::delete('/admin/product-groups/{productGroup}',       'Admin\ProductGroups\ProductGroupsController@destroy')->name('admin/product-groups/destroy');
});