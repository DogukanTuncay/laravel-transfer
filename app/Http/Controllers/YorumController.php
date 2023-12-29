<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yorum;
class YorumController extends Controller
{

    public function index() {
        $yorums = Yorum::with('user')->paginate(10);
        return view('layouts.admin.yorum.index',compact(['yorums']));
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|numeric',
            'rating' => 'required|numeric',
            'yorum' => 'required|string',
        ]);
        $yorum = Yorum::create([
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'yorum' => $request->yorum,
        ]);
        return redirect()->back()->with('success','Yorumunuz için teşekkür ederiz.');
    }

    public function destroy($id){
        $yorum = Yorum::find($id);
        if($yorum){
            $yorum->delete();
            return redirect()->back()->with('success','Yorum başarıyla silindi');

        }
        return redirect()->back()->with('error','Yorumu Silerken Hata Oluştu.');
    }

}
