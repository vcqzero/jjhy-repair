<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

// api
Route::namespace('Api')->group(function () {
    Route::middleware([
        'auth'
    ])->group(function () {
        // account
        Route::any('/account/edit', 'AccountController@edit');
        Route::any('/account/avatar', 'AccountController@avatar');
        Route::any('/account/validPassword', 'AccountController@validPassword');
        Route::any('/account/password', 'AccountController@password');
        Route::any('/account/create-role/{role}', 'AccountController@createRole');
        Route::any('/account/change-role', 'AccountController@changeRole');
        // website
        Route::any('/website/editWebsite', 'WebsiteController@editWebsite');
        Route::any('/website/upload', 'WebsiteController@upload');
        Route::any('/website/testEmail', 'WebsiteController@testEmail');
        Route::any('/website/testWeixin', 'WebsiteController@testWeixin');
        // settings
        Route::any('/settings/edit', 'SettingsController@edit');
        // workyard
        Route::any('/workyard/validName', 'WorkyardController@validName');
        Route::any('/workyard/add', 'WorkyardController@add');
        Route::any('/workyard/forbid/{id}', 'WorkyardController@forbid');
        Route::any('/workyard/check/{id}', 'WorkyardController@check');
        Route::any('/workyard/edit/{id}', 'WorkyardController@edit');
        // repair-type
        Route::any('/repair-type', 'RepairTypeController@index');
        Route::any('/repair-type/getSelectData', 'RepairTypeController@getSelectData');
        Route::any('/repair-type/validName', 'RepairTypeController@validName');
        Route::any('/repair-type/add', 'RepairTypeController@add');
        Route::any('/repair-type/edit/{id}', 'RepairTypeController@edit');
        Route::any('/repair-type/delete/{id}', 'RepairTypeController@delete');
        // repair-order
        Route::any('/repair-order/add', 'RepairOrderController@add');
        Route::any('/repair-order/edit/{id}', 'RepairOrderController@edit');
        Route::any('/repair-order/close/{id}', 'RepairOrderController@close');
        Route::any('/repair-order/complete/{id}', 'RepairOrderController@complete');
        Route::any('/repair-order/distribute/{id}', 'RepairOrderController@distribute');
        Route::any('/repair-order/set-can-offer/{id}', 'RepairOrderController@setCanOffer');
        Route::any('/repair-order/export', 'RepairOrderController@export');
        Route::any('/repair-order/comment/{id}', 'RepairOrderController@comment');
        //直接进行接单，不需竞价
        Route::any('/repair-order/take-order/{id}', 'RepairOrderController@takeOrder');
        // repair-order-grade
        Route::any('/repair-order-grade/getSelectData', 'RepairOrderGradeController@getSelectData');
        
        // offer
        Route::any('/offer/confirm/{offer_id}/{repair_order_id}', 'OfferController@confirm');
        Route::any('/offer/refuse/{id}', 'OfferController@refuse');
        Route::any('/offer/cancel/{id}', 'OfferController@cancel');
        Route::any('/offer/add', 'OfferController@add');
        Route::any('/offer/edit/{id}', 'OfferController@edit');
        // worker
        Route::any('/worker/add', 'WorkerController@add');
        Route::any('/worker/edit', 'WorkerController@edit');
        Route::any('/worker/forbid/{id}', 'WorkerController@forbid');
        Route::any('/worker/type/{type}/{id}', 'WorkerController@type');
        Route::any('/worker/check/{id}', 'WorkerController@check');
	    Route::any('/worker/add-certificate', 'WorkerController@addCertificate');
        Route::any('/worker/delete-certificate', 'WorkerController@deleteCertificate');
        // workyard-admin
        Route::any('/workyard-admin/forbid/{id}', 'WorkyardAdminController@forbid');
    });
    Route::any('/auth/login', 'AuthController@login')->name('auth/login');
    Route::any('/auth/logout', 'AuthController@logout')->name('auth/logout');
    // weixin
    Route::any('/weixin/store-weixin-location', 'WeixinController@storeWeixinLocation');
    // test
    Route::any('/test', 'TestController@index')->name('test/index');
});
