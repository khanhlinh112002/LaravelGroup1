<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Input, File;
use App\Http\Requests\addRoom;

// use Illuminate\Support\Facades\Session;

class PagesController extends Controller{
    public function index(){
        return view('index');
    }
    // public function about(){
    //     return view('about');
    // }
    public function addRooms (addRoom $Request){
        $image = $Request->file('roomImage');
        $path = $image->move('images', $image->getClientOriginalName());


        $newRoom = [
            'name' => $Request->roomName,
            'description' => $Request->roomDescription,
            'price' => $Request->roomPrice,
            'image' => $image->getClientOriginalName(),
        ];

        if (isset($_SESSION['rooms'])) {
            $_SESSION['rooms'][] = $newRoom;
        } else {
            if (session_id() === '')
                session_start();
            $_SESSION['rooms'][] = $newRoom;
        }
        echo '<script>alert("Thêm phòng thành công")</script>';
        return view('index');
    }
    public function destroy($id){
        if(isset($_SESSION['rooms']))
        $arr = $_SESSION['rooms'];
        return view('index')->with('arr',$arr);
    }

}

