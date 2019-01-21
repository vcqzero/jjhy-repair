<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\IndexController;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

// admin
Route::namespace('Admin')->group(function () {
    Route::middleware([
        'auth'
    ])->group(function () {
        // home
        Route::any('/', 'IndexController@index');
        // worker
        Route::any('/worker', 'WorkerController@index');
        Route::any('/worker/table-data/{status}', 'WorkerController@tableData');
        Route::any('/worker/view/{id}', 'WorkerController@view');
        Route::any('/worker/forbid/{id}', 'WorkerController@forbid');
        Route::any('/worker/type/{type}/{id}', 'WorkerController@type');
        Route::any('/worker/check/{id}', 'WorkerController@check');
        Route::any('/worker/worker-job', 'WorkerController@workerJob');
        Route::any('/worker/worker-job/table-data', 'WorkerController@workerJobTableData');
        // workyard-admin
        Route::any('/workyard-admin', 'WorkyardAminController@index');
        Route::any('/workyard-admin/table-data/{status}', 'WorkyardAminController@tableData');
        Route::any('/workyard-admin/view/{id}', 'WorkyardAminController@view');
        Route::any('/workyard-admin/forbid/{id}', 'WorkyardAminController@forbid');
        // website
        Route::any('/website', 'WebsiteController@index');
        Route::any('/website/api', 'WebsiteController@api');
        // settings
        Route::any('/settings', 'SettingsController@index');
        // itemType
        Route::any('/repair-type', 'RepairTypeController@index');
        Route::any('/repair-type/add', 'RepairTypeController@add');
        Route::any('/repair-type/edit/{id}', 'RepairTypeController@edit');
        Route::any('/repair-type/delete/{id}', 'RepairTypeController@delete');
        // workyard
        Route::any('/workyard', 'WorkyardController@index');
        Route::any('/workyard/table-data/{status}', 'WorkyardController@tableData');
        Route::any('/workyard/add', 'WorkyardController@add');
        Route::any('/workyard/view/{id}', 'WorkyardController@view');
        Route::any('/workyard/edit/{id}', 'WorkyardController@edit');
        Route::any('/workyard/forbid/{id}', 'WorkyardController@forbid');
        Route::any('/workyard/check/{id}', 'WorkyardController@check');
        // repair-order
        Route::any('/repair-order', 'RepairOrderController@index');
        Route::any('/repair-order/table-data/{status}', 'RepairOrderController@tableData');
        Route::any('/repair-order/view/{id}', 'RepairOrderController@view');
        Route::any('/repair-order/distribute/{id}', 'RepairOrderController@distribute');
        Route::any('/repair-order/set-can-offer/{id}', 'RepairOrderController@setCanOffer');
        Route::any('/repair-order/close/{id}', 'RepairOrderController@close');
        Route::any('/repair-order/pay/{id}', 'RepairOrderController@pay');
        // account
        Route::any('/account', 'AccountController@index');
    });
    
    Route::get('/login', 'AuthController@login')->name('admin/login');//can not delete route name
});

// weixin
Route::prefix('weixin')->namespace('Weixin')->group(function () {
    Route::middleware([
        'auth'
    ])->group(function () {
        //index
        Route::get('/', 'IndexController@index');
        Route::get('/index', 'IndexController@index');
        Route::get('/index/paginator', 'IndexController@paginator');
        //account
        Route::get('/account', 'AccountController@index');
        //repair-order
        Route::get('/repair-order', 'RepairOrderController@index');
        Route::get('/repair-order/add', 'RepairOrderController@add');
        Route::get('/repair-order/edit/{id}', 'RepairOrderController@edit');
        Route::get('/repair-order/paginateCompleted', 'RepairOrderController@paginateCompleted');
        Route::get('/repair-order/paginateClosed', 'RepairOrderController@paginateClosed');
        Route::get('/repair-order/worker-view/{id}', 'RepairOrderController@workerView');
        Route::get('/repair-order/take-order-success', 'RepairOrderController@takeOrderSuccess');
        Route::get('/repair-order/complete-order-success', 'RepairOrderController@completeOrderSuccess');
        Route::get('/repair-order/comment-page/{id}', 'RepairOrderController@commentPage');
        // workyard
        Route::get('/workyard/edit/{id}', 'WorkyardController@edit');
        Route::get('/workyard/add', 'WorkyardController@add');
        // worker
        Route::get('/worker/repair-order', 'WorkerController@repairOrder');
        Route::get('/worker/add-info', 'WorkerController@addInfo');
        Route::get('/worker/add-info-success', 'WorkerController@addInfoSuccess');
        Route::get('/worker/edit', 'WorkerController@edit');
        Route::any('/worker/view-certificate', 'WorkerController@viewCertificate');
        //offer
        Route::get('/offer/add/{repair_order_id}', 'OfferController@add');
        Route::get('/offer/edit/{id}', 'OfferController@edit');
        Route::get('/offer/success', 'OfferController@success');
        Route::get('/offer/paginateCompleted', 'OfferController@paginateCompleted');
        Route::get('/offer/paginateFailed', 'OfferController@paginateFailed');
        
    });
    Route::get('/login', 'AuthController@index')->name('weixin/login');
    Route::get('/oatuh', 'AuthController@oatuh')->name('weixin/oatuh');
    Route::any('/worker/add-certificate', 'WorkerController@addCertificate');
});
