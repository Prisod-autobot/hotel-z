<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

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
Route::get('/main', function () {
    return view('welcome');
});
Route::get('/all-room-type', [AuthController::class, 'roomType'])->name('all-room-types');
Route::get('/gallery', [AuthController::class, 'gallery'])->name('gallery');
Route::get('/', [AuthController::class, 'index'])->name('index');

Route::group(['middleware' => ['guest']], function () {
    // WEB PAGE
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login-user');
    // REGISTER LOGIN
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('register-user');

});

Route::get('/logout', [AuthController::class, 'logoutUser'])->name('logout');

// CHECK USER
Route::group(['middleware' => ['auth', 'prevent_back']], function () {
    Route::group(['middleware' => ['check_use:admin']], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        // Booking
        Route::get('getCourse/{id}', [BookingController::class, 'getRoomNum'])->name('getCourse');
        Route::get('getNumber/{id_date}', [BookingController::class, 'getNumber'])->name('getNumber');
        Route::get('getRoom/{id}', [BookingController::class, 'getRoom'])->name('getRoom');
        Route::get('/booking', [BookingController::class, 'index'])->name('booking');
        Route::post('/add-booking', [BookingController::class, 'addBooking'])->name('add-booking');
        Route::get('/delete-booking/{id}', [BookingController::class, 'deleteBooking'])->name('delete-booking');
        Route::get('/edit-booking/{id}', [BookingController::class, 'editBooking'])->name('edit-booking');
        Route::get('/edits-booking/{id}', [BookingController::class, 'editsBooking'])->name('edits-booking');
        Route::post('/update-booking/{id}', [BookingController::class, 'updateBooing'])->name('update-booking');
        // CUSTOMER
        Route::get('/customer', [AdminController::class, 'customer'])->name('customer');
        Route::post('/add-customer', [AdminController::class, 'addCustomer'])->name('add-customer');
        Route::get('/delete-cus/{id}', [AdminController::class, 'deleteCustomer'])->name('delete-cus');
        Route::get('/edit-customer/{id}', [AdminController::class, 'editCustomer'])->name('edit-customer');
        Route::post('/update-customer/{id}', [AdminController::class, 'updateCustomer'])->name('update-customer');
        // USER
        Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
        Route::get('/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit-user');
        Route::post('/update-user/{id}', [AdminController::class, 'updateUser'])->name('update-user');

        Route::get('/room', [AdminController::class, 'roomAll'])->name('room');
        Route::post('/room', [AdminController::class, 'roomAdd'])->name('add-room');
        Route::get('/delete-room/{id}', [AdminController::class, 'deleteRoom'])->name('delete-room');
        Route::get('/edit-room/{id}', [AdminController::class, 'editRoom'])->name('edit-room');
        Route::post('/update-room/{id}', [AdminController::class, 'updateRoom'])->name('update-room');

        Route::get('/room-type', [RoomController::class, 'roomType'])->name('roomtype');
        Route::post('/room-type', [RoomController::class, 'addRoomtype'])->name('addroomtype');
        Route::get('/delete-type/{id}', [RoomController::class, 'deleteRoomtype'])->name('delete-type');
        Route::get('/edit-roomtype/{id}', [RoomController::class, 'editRoomtype'])->name('edit-roomtype');
        Route::post('/update-roomtype/{id}', [RoomController::class, 'updateRoomtype'])->name('update-roomtype');

        Route::get('/add-image', [RoomController::class, 'allImage'])->name('image');
        Route::post('/add-image', [RoomController::class, 'addImage'])->name('addimage');
        Route::get('/delete-img/{id}', [RoomController::class, 'deleteImg'])->name('delete-img');

        Route::get('/service', [RoomController::class, 'service'])->name('service');
        Route::post('/service', [RoomController::class, 'addService'])->name('add-service');
        Route::get('/service/{id}', [RoomController::class, 'deleteService'])->name('delete-service');
        Route::get('/edit-service/{id}', [RoomController::class, 'editService'])->name('edit-service');
        Route::post('/update-service/{id}', [RoomController::class, 'updateService'])->name('update-service');
    });

    Route::group(['middleware' => ['check_use:member']], function () {
        Route::get('/home', [MemberController::class, 'index'])->name('home');
        Route::get('/cancel-book/{id}', [MemberController::class, 'cancelBook'])->name('cancel-book');
        Route::post('/', [MemberController::class, 'reserveBook'])->name('reserve-room');
        Route::post('/home', [MemberController::class, 'updateData'])->name('update-data');
        Route::post('/confirm', [MemberController::class, 'userConfirm'])->name('user-booking');
        Route::post('/user-book', [MemberController::class, 'userBook'])->name('user-book');
    });
});