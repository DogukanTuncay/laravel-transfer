<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kupon;
class KuponController extends Controller
{
    function store(Request $request) {
        $kupon = Kupon::create([
            'user_id' => $request->user_id,
            'indirimYuzde' => $request->kuponYuzde
        ]);
        return redirect()->back()->with('success','Kupon Başarı ile Eklendi');
    }
    function destroy($id) {
        $kupon = Kupon::find($id);
        if($kupon){
            $kupon->delete();
            return redirect()->back()->with('success','Kupon Başarı İle Silindi.');
        }
        else{
            return redirect()->back()->with('error','Kupon Silinemedi.');

        }
    }
}
