<?php

namespace App\Http\Controllers;

use App\Models\ImageAll;
use App\Models\Images;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{

    public function __construct()
    {
        $this->RoomType = new RoomType();
    }
    public function roomType(Request $request)
    {
        $image = Images::all();
        $service = Service::all();
        // $data = RoomType::with('relationImage', 'relationService')->get();
        $data = DB::table('room_types')
            ->leftJoin('services', 'room_types.room_service', '=', 'services.id')
            ->leftJoin('images', 'room_types.img_id', '=', 'images.id')
            ->select('room_types.*', 'services.name as service_name', 'images.caption')
            ->get();

        // return dd($data);
        return view('admin.roomType', compact('data', 'service', 'image'));
    }

    public function allImage()
    {
        $info_img = Images::all();
        return view('admin.image', compact('info_img'));
    }

    public function service()
    {
        $service = Service::all();
        return view('admin.service', compact('service'));
    }

    public function addService(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|min:4',
            'description' => 'required|max:1000',
        ]);
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $res = $service->save();

        if ($res) {
            return redirect()->route('service')->with('success', 'Success!!');
        } else {
            return redirect()->route('service')->with('fail', 'Something went wrong!!');
        }
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service')->with('success', 'Delete Success!!');
    }

    public function deleteRoomtype($id)
    {
        $data = RoomType::find($id);
        $data->delete();
        return redirect()->route('roomtype')->with('success', 'Delete Success!!');
    }

    public function editService($id)
    {
        $service = Service::all();
        $data_service = Service::find($id);
        return view('admin.updateser', compact('data_service', 'service'));
    }

    public function updateService(Request $request, $id)
    {
        $input = $request->all();
        $service = Service::find($id);
        $service->name = $input['name'];
        $service->description = $input['description'];

        $service->save();
        return redirect()->route('service')->with('success', 'Update data Success!!');
    }

    public function addImage(Request $request)
    {
        $img_type = new Images();
        $x = 20;
        $name_img = $request->name;
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $extension_img = $request->file->extension();
            $combine = $name_img . '_' . time() . '.' . $extension_img;
            $img = \Image::make($file);
            $img->save(public_path('storeImage/' . $combine), $x);

            $img_type->name = $name_img;
            $img_type->caption = $combine;

            $img_type->save();
        }
        $i = 1;
        if ($request->hasFile("imgs")) {
            $files = $request->file("imgs");
            foreach ($files as $file) {
                $extension_img = $file->extension();
                $combine = $name_img . '_' . $i++ . '.' . $extension_img;

                $request['post_id'] = $img_type->id;
                $request['caption'] = $combine;
                $request['name'] = $request->name;

                $img = \Image::make($file);
                $img->save(public_path('storeImage/' . $combine), $x);

                ImageAll::create($request->all());
            }
        }
        return redirect()->route('image')->with('success', 'Uploade success');
    }

    public function deleteImg($id)
    {
        $img_db = Images::findOrFail($id);
        $img_name = $img_db->caption;
        if (File::exists(public_path('storeImage/' . $img_name))) {
            File::delete(public_path('storeImage/' . $img_name));
        }
        $imgs = ImageAll::where("post_id", $img_db->id)->get();
        foreach ($imgs as $img) {
            if (File::exists(public_path('storeImage/' . $img->caption))) {
                File::delete(public_path('storeImage/' . $img->caption));
            }
        }
        $img_db->delete();
        return redirect()->route('image')->with('success', 'Delete Success');
    }

    public function addroomtype(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
            'discount' => 'required',
            'size' => 'required',
            'adult' => 'required|max:7|min:1',
            'child' => 'required|max:7|min:0',
            'description' => 'required',
        ]);

        $room_type = new RoomType();
        $room_type->name = $request->name;
        $room_type->cost_per_day = $request->cost;
        $room_type->discount_percentage = $request->discount;
        $room_type->size = $request->size;
        $room_type->max_adult = $request->adult;
        $room_type->max_child = $request->child;
        $room_type->description = $request->description;
        $room_type->room_service = $request->service;
        $room_type->img_id = $request->img;

        $res = $room_type->save();
        if ($res) {
            return redirect()->route('roomtype')->with('success', 'Successfully');
        } else {
            return redirect()->route('roomtype')->with('fail', 'Fail');
        }
    }

    public function editRoomtype($id)
    {
        $image = Images::all();
        $service = Service::all();
        $type = RoomType::all();

        $data = RoomType::find($id);
        return view('admin.updatetype', compact('data', 'type', 'image', 'service'));
    }

    public function updateRoomtype(Request $request, $id)
    {
        $input = $request->all();
        $room_type = RoomType::find($id);
        $room_type->name = $input['name'];
        $room_type->cost_per_day = $input['cost'];
        $room_type->discount_percentage = $input['discount'];
        $room_type->size = $input['size'];
        $room_type->max_adult = $input['adult'];
        $room_type->max_child = $input['child'];
        $room_type->room_service = $input['service'];
        $room_type->img_id = $input['img'];
        $room_type->description = $input['description'];

        $room_type->save();
        return redirect()->route('roomtype')->with('success', 'Update data Success!!');
    }
}