<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropshipperController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {return view('home');});

Route::get('registerOwner', 'MainController@registerOwner')->name('registerOwner');
Route::get('registerDropshipper', 'MainController@registerDropshipper')->name('registerDropshipper');
Route::post('registerOwnerAttempt', 'MainController@registerOwnerAttempt')->name('registerOwnerAttempt');
Route::post('registerDropshipperAttempt', 'MainController@registerDropshipperAttempt')->name('registerDropshipperAttempt');

Route::get('login', 'MainController@login')->name('login');
Route::post('loginAttempt', 'MainController@loginAttempt')->name('loginAttempt');
Route::post('loginAttempt-admin', 'AdminController@loginAttempt')->name('adminLoginAttempt');

Route::group(['middleware' => 'auth'], function() {
  Route::get('ownerhome', 'OwnerController@getDropshipper')->name('ownerhome');
  Route::get('good', 'OwnerController@showGood')->name('good');
  Route::get('order', 'OrderController@showOrder')->name('order');
  Route::get('profile', 'OwnerController@showProfile')->name('profile');
  Route::patch('ownerProfileUpdate', 'OwnerController@updateOwnerProfile')->name('ownerProfileUpdate');
  Route::delete('destroyGood/{id}', 'GoodController@destroyGood')->name('destroyGood');
  Route::get('createGood', 'GoodController@createGood')->name('createGood');
  Route::post('storeGood', 'GoodController@storeGood')->name('storeGood');
  Route::get('editGood/{id}', 'GoodController@editGood')->name('editGood');
  Route::patch('updateGood', 'GoodController@updateGood')->name('updateGood');
  Route::patch('cancelOrder/{id}', 'OrderController@cancelOrder')->name('cancelOrder');
  Route::patch('sentOrder/{id}', 'OrderController@sentOrder')->name('sentOrder');
  Route::put('rejectOrder/{id}', 'OrderController@rejectOrder')->name('rejectOrder');
  Route::put('endOrder/{id}', 'OrderController@endOrder')->name('endOrder');
  Route::get('dropshipper-saya', 'PartnerController@getOwnerPartners')->name('myDropshippers');
  Route::post('addPartner/{dropshipperId}', 'PartnerController@addPartner')->name('addPartner');
  Route::delete('deletePartner/{dropshipperId}', 'PartnerController@destroyPartner')->name('deletePartner');

  Route::get('dropshipperhome', 'DropshipperController@getGoods')->name('dropshipperhome');
  Route::get('goodCategory/{id}', 'DropshipperController@showGoodCategory')->name('goodCategory');
  Route::get('goodDetail/{id}', 'DropshipperController@goodDetail')->name('goodDetail');
  Route::get('dropshipperOrder', 'OrderController@showDropshipperOrder')->name('dropshipperOrder');
  Route::get('dropshipperProfile', 'DropshipperController@showDropshiperProfile')->name('dropshipperProfile');
  Route::patch('dropshipperProfileUpdate', 'DropshipperController@updateDropshipperProfile')->name('dropshipperProfileUpdate');
  Route::get('owner', 'DropshipperController@getOwner')->name('owner');
  Route::get('ownerDetail/{id}', 'DropshipperController@getOwnerDetail')->name('ownerDetail');
  Route::post('storeOrder/{id}', 'OrderController@storeOrder')->name('storeOrder');
  Route::get('cart', 'CartController@showCart')->name('cart');
  Route::post('addToCart/{id}', 'CartController@addToCart')->name('addToCart');
  Route::delete('destroyCart/{id}', 'CartController@destroyCart')->name('destroyCart');
  Route::post('checkout/{id}', 'CartController@checkout')->name('checkout');
  Route::patch('cancelOrderByDropshipper/{id}', 'OrderController@cancelOrderByDropshipper')->name('cancelOrderByDropshipper');
  Route::patch('receivedOrder/{id}', 'OrderController@endOrder')->name('receivedOrder');
  Route::patch('updatePayment/{id}', 'OrderController@updatePayment')->name('updatePayment');
  Route::patch('complaint/{id}', 'OrderController@complaint')->name('complaint');

  Route::get('adminhome', 'AdminController@showHome')->name('adminhome');
  Route::get('ordersDone', 'AdminController@showOrdersDone')->name('adminOrdersDone');
  Route::patch('rejectReceipt/{id}', 'AdminController@rejectReceipt')->name('rejectReceipt');
  Route::patch('approveReceipt/{id}', 'AdminController@approveReceipt')->name('approveReceipt');
});

Route::post('logout', 'MainController@logout')->name('logout');