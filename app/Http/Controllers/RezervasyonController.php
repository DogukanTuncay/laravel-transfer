<?php

namespace App\Http\Controllers;

use App\Models\Rezervasyon;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Models\Kupon;

class RezervasyonController extends Controller
{
    public function index(Request $request){
        $rezervasyonlar = Rezervasyon::paginate(10);
        return redirect()->route('rezervasyon',compact(['rezervasyonlar']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nereden_id' => 'required',
            'nereye_id' => 'required',
            'yetiskin' => 'required|numeric',
            'cocuk' => 'required|numeric',
            'date' => 'required|date',
            'parabirimi' => 'required',
            'fiyat' => 'required|numeric',
            'arac_turu_id' => 'required',
            'isim' => 'required',
            'soyisim' => 'required',
            'phone' => 'required',
        ]);
        $rezervasyon= Rezervasyon::create([
            'nereden_id' => $request->nereden_id,
            'nereye_id' =>$request->nereye_id,
            'yetiskin' =>$request->yetiskin,
            'cocuk' =>$request->cocuk,
            'date' => $request->date,
            'hour' => $request->hour,
            'parabirimi' =>$request->parabirimi,
            'fiyat' => $request->fiyat,
            'arac_turu_id' =>$request->arac_turu_id,
            'isim' => $request->isim,
            'soyisim' =>$request->soyisim,
            'phone' => $request->phone['main'],
        ]);
        $kuponSil = Kupon::find($request->kuponId);
        if($rezervasyon){
            return redirect()->back()->with('success','Rezervasyonunuz Başarı İle Oluşturuldu.');
        }
            return redirect()->back()->with('error','Rezervasyonunuzu Oluştururken Bir Hata ile Karşılaştık. Lütfen bize aşağıdaki numaralardan ulaşın.');
    }

    public function destroy($id) {
        $rezervasyon = Rezervasyon::find($id);
        if (!$rezervasyon) {
            return redirect()->back()->with('error', 'Rezervasyon bulunamadı.');
        }
        $rezervasyon->delete();
        return redirect()->back()->with('success', 'Rezervasyon başarıyla silindi.');
    }
}
