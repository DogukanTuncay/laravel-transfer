<?php

namespace App\Http\Controllers;

use App\Models\AracTuru;
use App\Models\Konum;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(){
        $transfers = Transfer::all();
        $araclar = AracTuru::all()->load('transfer');
        $konumlar = Konum::all();
        return view('layouts.admin.transfer.index',compact(['konumlar','transfers','araclar']));
    }


    public function store(Request $request){
        $request->validate([
            'nereden' => 'required|integer',
            'nereye' => 'required|integer',
            'fiyat' => 'required',
            'arac' => 'required|integer',
        ]);
        $transfer = Transfer::create([
            'nereden_id' => $request->nereden,
            'nereye_id' => $request->nereye,
            'fiyat' => $request->fiyat,
            'arac_turu_id' => $request->arac,
        ]);
        if($transfer){
            return redirect()->back()->with('success','Yeni Transfer Başarıyla Eklendi');
        }
    }

    public function destroy($id)
     {

        try{
            $transfer= Transfer::find($id);
            if ($transfer) {

                $transfer->delete();
                return redirect()->route('users')->with('success', 'Transfer Başarıyla Silindi');
            }

        } catch(\Throwable $th){
            return back()->withInput()->with('error', 'Transferi silerken hata oldu:'.$th);

         }
         return back()->withInput()->with('error', 'Transferi Silerken hata oldu.');
     }
     public function update(Request $request) {

        $validatedData = $request->validate([
            'fiyat' => 'required',
            'id' => 'required'
        ]);
        $transfer = Transfer::find($request->id);

        if (!$transfer) {
            return redirect()->back()->with('error','Transferi  Bulunamadı.');
        }

        // Verileri güncelle
        $transfer->fiyat = $request->input('fiyat');

        $transfer->save();

        return redirect()->back()->with('success','Transfer  Başarıyla Güncellendi.');

    }
}
