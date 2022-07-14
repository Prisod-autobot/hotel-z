<?php

namespace App\Http\Controllers;

use App\Models\ImageAll;
use App\Models\Images;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        // $data = RoomBooking::where('user_id', $id)->get();
        $data = DB::table('room_bookings')
            ->leftJoin('room_types', 'room_types.id', '=', 'room_bookings.room_type_id')
            ->where('room_bookings.user_id', $id)
            ->select('room_bookings.*', 'room_types.name as room_type_name')
            ->get();

        if (session('success_message')) {
            toast(session('success_message'), 'success');
        }
        if (session('error_message')) {
            Alert::error('Error', session('error_message'));
        }
        return view('home', compact('data'));
    }

    public function login()
    {
        return view('home');
    }

    public function register()
    {
        return view('home');
    }
    public function gallery()
    {
        $id = Auth::id();
        $data = DB::table('room_bookings')
            ->leftJoin('room_types', 'room_types.id', '=', 'room_bookings.room_type_id')
            ->where('room_bookings.user_id', $id)
            ->select('room_bookings.*', 'room_types.name as room_type_name')
            ->get();

        $img = ImageAll::all();
        return view('nav.gallery', compact('img', 'data'));
    }
    public function roomType()
    {
        $id = Auth::id();
        $datax = DB::table('room_bookings')
            ->leftJoin('room_types', 'room_types.id', '=', 'room_bookings.room_type_id')
            ->where('room_bookings.user_id', $id)
            ->select('room_bookings.*', 'room_types.name as room_type_name')
            ->get();

        $image = Images::all();
        $service = Service::all();
        $data = DB::table('room_types')
            ->leftJoin('services', 'room_types.room_service', '=', 'services.id')
            ->leftJoin('images', 'room_types.img_id', '=', 'images.id')
            ->select('room_types.*', 'services.description as service_name', 'images.caption')
            ->get();

        return view('nav.roomtype', compact('data', 'service', 'image', 'datax'));
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed|max:20',
        ]);
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $res = $users->save();

        if ($res) {
            return redirect('/')->withSuccessMessage('You have registered successfully');
        } else {
            return redirect('/')->withErrorMessage('Something went wrong');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);

        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                // return back();
                return redirect('/')->withSuccessMessage('Login successfully');
                // return redirect()->intended('admin');
            } elseif ($user->level == 'member') {
                return redirect('/')->withSuccessMessage('Login successfully');
                // return back();
                // return redirect()->intended('home');
            }
            // return back();
            // return redirect()->intended('/');
            return back()->with('fail', 'Something went wrong');
        }
        Alert::toast('Email or Password incorrect', 'error');
        return back()->with('fail', 'Email or Password incorrect');
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }
}