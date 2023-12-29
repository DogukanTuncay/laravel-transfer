<?php

namespace App\Http\Controllers;
use Yoeunes\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Models\Konum;

class KonumController extends Controller
{
    public function index(){
        $konums = Konum::paginate(10);
        return view('layouts.admin.konum.index',compact(['konums']));

    }
    public function store(Request $request){
        $request->validate([
            'konum' => 'required|string',
        ]);

        $konum = Konum::create([
            'konum_adi' => $request->konum,
        ]);
        $konums = Konum::paginate(10);

        toastr()->success('İşlem Başarıyla Gerçekleşti!');
        return redirect()->route('konum');
    }
    public function destroy($id){
        $konum = Konum::find($id);
            if ($konum) {

                $konum->delete();
                toastr()->success('İşlem Başarıyla Gerçekleşti!');
                return redirect()->route('konum');
            }
    }
}
