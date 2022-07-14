<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::count();
        $cus = Customer::count();
        $book1 = RoomBooking::where('status', 'pending')->count();
        $book2 = RoomBooking::where('status', 'checked_in')->count();
        $book3 = RoomBooking::where('status', 'checked_out')->count();
        $book4 = RoomBooking::where('status', 'cancelled')->count();
        $book5 = RoomBooking::where('status', 'checked_in')->sum('room_cost');

        return view('admin.index', compact('user', 'cus', 'book1', 'book2', 'book3', 'book4', 'book5'));
    }

    public function addCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'id_card' => 'required|unique:customers|max:13',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->gender = $request->gen;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->email = $request->mail;
        $customer->id_card = $request->id_card;

        $customer->save();
        return redirect()->route('customer')->with('successcus', 'Create Success!!');
    }

    public function editCustomer($id)
    {
        $customer = Customer::all();
        $data_customer = Customer::find($id);
        return view('admin.updateCustomer', compact('customer', 'data_customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $input = $request->all();
        $cus = Customer::find($id);
        $cus->name = $input['name'];
        $cus->gender = $input['gen'];
        $cus->address = $input['addx'];
        $cus->phone = $input['phone'];

        // return dd($cus);
        $cus->save();
        return redirect()->route('customer')->with('success', 'Update data Success!!');
    }

    public function deleteCustomer($id)
    {
        $data = Customer::find($id);
        $data->delete();
        return redirect()->route('customer')->with('success', 'Delete Success!!');
    }

    public function deleteUser($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('customer')->with('success', 'Delete Success!!');
    }

    public function editUser($id)
    {
        $user = User::all();
        $data_user = User::find($id);
        return view('admin.updateuser', compact('user', 'data_user'));
    }
    public function customer()
    {
        $user = User::all();
        $book = RoomBooking::all();
        $room_type = RoomType::all();
        $data = User::all();
        $cus = Customer::all();
        return view('admin.user', compact('user', 'data', 'book', 'cus', 'room_type'));
    }

    public function updateUser(Request $request, $id)
    {
        $input = $request->all();
        $users = User::find($id);
        $users->name = $input['name'];
        $users->gender = $input['gen'];
        $users->address = $input['addx'];
        $users->level = $input['lev'];
        $users->phone = $input['phone'];

        // return dd($users);
        $users->save();
        return redirect()->route('customer')->with('success', 'Update data Success!!');
    }

    public function roomAll(Request $request)
    {
        $room = Room::all();
        $type = RoomType::all();
        $book = RoomBooking::all();

        $data = DB::table('rooms')
            ->leftJoin('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->leftJoin('room_bookings', 'rooms.booking_id', '=', 'room_bookings.id')
            ->select('rooms.*', 'room_types.name as room_types', 'room_bookings.id as book_id')
            ->get();
        return view('admin.room', compact('room', 'data', 'type', 'book'));
    }

    public function roomAdd(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms|min:3',
            'description' => 'required',
        ]);

        $room_type_id = $request->type;
        $available = $request->available;
        $status = $request->status;
        $booking_id = $request->book;
        $description = $request->description;

        $room_num = $request->room_number;
        $num = $request->many_room;
        $x = 0;
        $datasave = [];
        for ($i = 1; $i <= $num; $i++) {
            $allin = $room_num + $x;
            $datasave[] = [
                'room_number' => $allin,
                'room_type_id' => $room_type_id,
                'available' => $available,
                'status' => $status,
                'booking_id' => $booking_id,
                'description' => $description,
            ];
            $x += 1;
            //
        }
        DB::table('rooms')->insert($datasave);
        // echo "<pre/>";
        // print_r($datasave);
        return redirect()->route('room')->with('success', 'Success!!');
    }

    public function deleteRoom($id)
    {
        $data = Room::find($id);
        $data->delete();
        return redirect()->route('room')->with('success', 'Delete Success!!');
    }

    public function editRoom($id)
    {
        $type = RoomType::all();
        $book = RoomBooking::all();
        $roms = Room::all();
        $data_room = Room::find($id);
        return view('admin.updateroom', compact('roms', 'data_room', 'type', 'book'));
    }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_number' => 'required|min:3',
            'description' => 'required',
        ]);
        $input = $request->all();
        $data_room = Room::find($id);
        $data_room->room_number = $input['room_number'];
        $data_room->status = $input['status'];
        $data_room->available = $input['available'];
        $data_room->booking_id = $input['booking'];
        $data_room->room_type_id = $input['type'];
        $data_room->description = $input['description'];

        $data_room->save();
        return redirect()->route('room')->with('success', 'Update data Success!!');
    }
}