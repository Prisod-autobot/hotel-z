<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\RoomBooking;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function cancelBook($id)
    {
        $data = RoomBooking::find($id);
        $data->status = 'cancelled';
        $data->arrival_date = null;
        $data->departure_date = null;
        $data->save();
        return back();
    }

    public function reserveBook(Request $request)
    {
        $request->validate([
            'date_in' => 'required',
            'date_out' => 'required',
        ]);

        $date_in = $request->date_in;
        $date_out = $request->date_out;
        $adult = $request->max_adult;
        $chile = $request->max_child;

        $book = RoomBooking::all();
        $image = Images::all();
        $service = Service::all();
        $data = DB::table('room_types')
            ->leftJoin('services', 'room_types.room_service', '=', 'services.id')
            ->leftJoin('images', 'room_types.img_id', '=', 'images.id')
        // ->leftJoin('rooms', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('room_types.*', 'services.name as service_name', 'images.caption')
            ->get();

        // $data2 = DB::select("SELECT room_types.*,services.name as service_name,images.caption
        // FROM room_types,services,images
        // LEFT JOIN rooms ON rooms.room_type_id = 5
        // WHERE  room_types.room_service = services.id
        // AND room_types.img_id = images.id
        // AND rooms.id NOT IN (SELECT room_id FROM room_bookings WHERE
        // '$date_in' BETWEEN arrival_date AND departure_date)");

        $id = Auth::id();
        $user_check = User::find($id);

        $arrive = $request->date_in;
        if (!$user_check->phone || !$user_check->gender || !$user_check->address || !$user_check->id_card) {
            Alert::error('Information is required', session('Information is required'));
            return back()->with('fail', 'Bad');
        } else {
            // return dd($data);
            return view('booking', compact('data', 'date_in', 'date_out', 'adult', 'chile'));
        }
    }

    public function updateData(Request $request)
    {
        $request->validate([
            'tel' => 'required|min:10|max:10',
            'id_card' => 'required',
            'address' => 'required',
        ]);

        $data = User::find($request->id);
        $input = $request->all();

        $data->phone = $input['tel'];
        $data->gender = $input['gender'];
        $data->id_card = $input['id_card'];
        $data->address = $input['address'];

        $data->save();
        Alert::success('Information updated', session('Information is required'));
        return back();
    }

    public function userConfirm(Request $request)
    {
        $user_id = Auth::id();
        $id = User::find($user_id);
        $mail = $id->email;
        $name = $id->name;
        $phone = $id->phone;
        $id_num = $id->id_card;
        $type = $request->type;
        $room_type = RoomType::find($type);
        $date_in = $request->date_in;
        $date_out = $request->date_out;
        $adult = $request->adult;
        $chile = $request->chile;

        $data = DB::select("SELECT rooms.* ,room_types.name,room_types.cost_per_day FROM rooms,room_types
        WHERE  room_types.id = rooms.room_type_id
        AND rooms.room_type_id = '$type'
        AND rooms.id NOT IN (SELECT room_id FROM room_bookings WHERE
        '$date_in' BETWEEN arrival_date AND departure_date) ORDER BY rooms.room_number")[0];

        // if (mysqli_num_rows($data) == 0) {
        //     return redirect('/')->withErrorMessage('No room found');
        // } else {
        return view('confirm', compact('phone', 'id_num', 'data', 'name', 'mail', 'room_type', 'date_in', 'date_out', 'adult', 'chile'));
    }

    public function userBook(Request $request)
    {
        $id = Auth::id();
        $booking = new RoomBooking();
        $booking->arrival_date = $request->date_in;
        $booking->departure_date = $request->date_out;
        $booking->room_cost = $request->cost;
        $booking->status = 'pending';
        $booking->payment = 2;
        $booking->room_id = $request->room_num;
        $booking->user_id = $id;
        $booking->childe = $request->chile;
        $booking->adult = $request->adult;
        $booking->room_type_id = $request->type;

        $booking->save();
        return redirect('/')->withSuccessMessage('Booking successfully');
    }
}