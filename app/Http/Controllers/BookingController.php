<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $data_book = RoomBooking::all();
        $customers = Customer::all();
        $user = User::all();
        $type = RoomType::all();
        $data = DB::table('room_bookings')
            ->join('customers', 'room_bookings.cus_id', '=', 'customers.id')
            ->join('room_types', 'room_bookings.room_type_id', '=', 'room_types.id')
            ->join('rooms', 'room_bookings.room_id', '=', 'rooms.id')
            ->select('room_bookings.*', 'customers.name as cus_name', 'customers.phone as cus_phone', 'customers.id as cus_id',
                'rooms.room_number', 'rooms.room_type_id', 'room_types.cost_per_day as cost')
            ->get();

        $data_ex = DB::table('room_bookings')
            ->join('users', 'room_bookings.user_id', '=', 'users.id')
            ->join('room_types', 'room_bookings.room_type_id', '=', 'room_types.id')
            ->join('rooms', 'room_bookings.room_id', '=', 'rooms.room_number')
            ->select('room_bookings.*', 'users.name as use_name', 'users.phone as use_phone', 'users.id as use_id',
                'rooms.room_number', 'rooms.room_type_id', 'room_types.cost_per_day as cost')
            ->get();

        // return dd($data_ex);
        return view('admin.book', compact('data_book', 'type', 'data', 'data_ex', 'user', 'customers'));
    }

    public function deleteBooking($id)
    {
        $data = RoomBooking::find($id);
        $room = $data->room_id;
        $booking_room = Room::find($room);
        $booking_room->booking_id = null;

        $booking_room->save();
        $data->delete();
        return redirect()->route('booking')->with('success', 'Delete Success!!');
    }

    public function editBooking($id)
    {
        $booking = RoomBooking::find($id);
        $room_type = $booking->room_type_id;
        $type = RoomType::find($room_type);
        $data_use = $booking->user_id;
        $data_cus = $booking->cus_id;
        $user = User::find($data_use);
        $customers = Customer::find($data_cus);

        return view('admin.updatebook', compact('booking', 'type', 'user', 'customers'));
    }

    public function editsBooking($id)
    {
        $booking = RoomBooking::find($id);
        $room_type = $booking->room_type_id;
        $type = RoomType::find($room_type);
        $data_use = $booking->user_id;
        $data_cus = $booking->cus_id;
        $user = User::find($data_use);
        $customers = Customer::find($data_cus);

        return view('admin.updatebooks', compact('booking', 'type', 'user', 'customers'));
    }

    public function updateBooing(Request $request, $id)
    {
        $input = $request->all();
        $data_booking = RoomBooking::find($id);
        $data_booking->adult = $input['max_adult'];
        $data_booking->childe = $input['max_child'];
        $data_booking->status = $input['status'];
        $data_booking->payment = $input['payment'];

        $data_booking->save();
        return redirect()->route('booking')->with('success', 'Update data Success!!');
    }

    public function getRoomNum($id)
    {
        // $room_num = Room::where('room_type_id', $id)->whereNull('booking_id')->get();
        $room_num = DB::table('rooms')
            ->where('room_type_id', $id)
            ->get();
        return response()->json($room_num);
    }

    public function getNumber(Request $request, $id_date)
    {
        $ar_room = DB::select("SELECT rooms.* ,room_types.name,room_types.cost_per_day FROM rooms,room_types WHERE room_types.id = rooms.room_type_id AND rooms.id NOT IN (SELECT room_id FROM room_bookings WHERE
        '$id_date' BETWEEN arrival_date AND departure_date) ORDER BY rooms.room_number");
        return response()->json($ar_room);
    }

    public function addBooking(Request $request)
    {
        $request->validate([
            'arrive' => 'required',
            'depart' => 'required',
        ]);

        $room_f = $request->room_num;
        $data = Room::find($room_f);
        $room_t = $data->room_type_id;
        $room_tc = RoomType::find($room_t);
        $cost = $room_tc->cost_per_day;

        $date_in = $request->arrive;
        $date_out = $request->depart;

        $fdate = strtotime($date_in);
        $tdate = strtotime($date_out);
        $total = $tdate - $fdate;
        $day = floor($total / 86400);
        $result_cost = $day * $cost;

        $booking = new RoomBooking();
        $booking->arrival_date = $request->arrive;
        $booking->departure_date = $request->depart;
        $booking->cus_id = $request->book_cus;
        $booking->status = $request->status;
        $booking->payment = $request->payment;
        $booking->room_type_id = $room_t;
        $booking->room_id = $request->room_num;
        $booking->childe = $request->max_child;
        $booking->adult = $request->max_adult;
        $booking->room_cost = $result_cost;
        $booking->booking_id = 1;

        $booking->save();
        return redirect()->route('booking')->with('success', 'Create Booking Success!!');
    }
}