<?php

use App\Http\Controllers\admin\RoomController;
use App\Models\Rooms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('admin.login');
});

Route::prefix('web')->group(function () {
    Route::get('/', function(){
        return view('layouts.web');
    })->name('home');

    Route::get('/info-user', function(){
        if(session('logUser')){
            return view('layouts.inc.website.infor');
        }
        return redirect()->route('home');
    })->name('infor');

    Route::get('/logout', function(){
        session('logUser') ? session()->forget('logUser') : null;
        return redirect()->back();
    })->name('logoutUser');
});

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', function() {
            return view('admin.login');
        })->withoutMiddleware('admin')->name('admin.login');

        Route::prefix('category')->group(function () {
            Route::get('/type-room', function(){
                return view('admin.category.typeRoom');
            })->name('admin.category.type');
            Route::get('/no-of-room', function(){
                return view('admin.category.noofRoom');
            })->name('admin.category.noof');
        });

        Route::prefix('book')->group(function () {
            Route::get('/booking/{room}', function($room){
                $check = Rooms::where('id', $room)->first();
                if (!$check) {
                    return redirect()->route('admin.bookingManagement')->with('error', 'Không có phòng này!');
                }
                
                if ($check->checkRoom() === 'waite'){
                    return redirect()->route('admin.bookingManagement')->with('error', 'Phòng này đang được đặt!');
                } elseif ($check->checkRoom() === 'confirm'){
                    return redirect()->route('admin.bookingManagement')->with('error', 'Phòng này đang có người ở!');
                }

                return view('admin.booking.booking', ['room' => $room]);
            })->name('admin.booking');
            
            Route::get('/booking-management', function(){
                return view('admin.booking.bookingManagement');
            })->name('admin.bookingManagement');

            Route::get('/history-book', function(){
                return view('admin.booking.historyBook');
            })->name('admin.historyBook');
        });

        Route::get('/dashboard', function(){
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/payment', function(){
            return view('admin.payment');
        })->name('admin.payment');

        Route::prefix('user')->group(function () {
            Route::get('/show', function(){
                return view('admin.user.user');
            })->name('admin.user');
        });

        Route::get('/logout', function(){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        })->name('admin.logout');
    });
});