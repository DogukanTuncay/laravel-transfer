<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AracOzellik;
use App\Models\AracTuru;
use Yoeunes\Toastr\Toastr;
class AracController extends Controller
{
    public function index()
    {
        $araclar = AracTuru::all()->load('ozellikler');
        return view('layouts.admin.aracTuru.index', compact('araclar'));
    }
    // Yeni araç ekleme
    public function store(Request $request)
    {
        try {
            $request->validate([
                'arac_tur_adi' => 'required|string|max:25',
                'koltuk_sayisi' => 'required|integer',
                'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            ]);
            // Dosyayı al

        // Dosya var mı kontrol et
        if ($request->file('image_url')) {
        $image = $request->file('image_url');
            $filename = 'assets/images/aracTur/' . now()->timestamp . '.' . $image->getClientOriginalExtension();

            // Dosyayı kaydet
            $image->move(public_path('assets/images/aracTur'), $filename);

            // Yeni arac oluştur
            $arac = AracTuru::create([
                'arac_tur_adi' => $request->input('arac_tur_adi'),
                'koltuk_sayisi' => $request->input('koltuk_sayisi'),
                'arac_resim' => $filename,]); // Dosya yolunu veritabanına kaydet

            return redirect()->route('aracTuru')->with('success', 'Araç Türü Başarıyla Eklendi');
        }

        }

        catch (\Throwable $th) {
            return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.'.$th);
        }



        // Ekleme işlemi tamamlandıktan sonra bir yönlendirme veya mesaj döndürebilirsiniz
    }


    // Araç silme
    public function destroy(Request $request)
    {
        $id = $request->aracDeleteId;
        try {
            // Aracı bul
        $arac = AracTuru::find($id);
        if ($arac) {
            // Aracı sil
            $arac->delete();
            // Silme işlemi tamamlandıktan sonra bir yönlendirme veya mesaj döndürebilirsiniz
        return redirect()->route('aracTuru')->with('success', 'Araç Başarıyla Silindi');
        }
        return redirect()->route('aracTuru')->with('error', 'Araç Bulunamadı');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.'.$th);
        }

    }

 // ÖZELLİK ALANI


    public function ozellikStore(Request $request)
    {

        try {
            $request->validate([
                'arac_id' => 'required|integer|max:10',
                'ozellik' => 'required|string|max:40',
            ]);
        AracOzellik::create([
            'arac_id' => $request->input('arac_id'),
            'ozellik' => $request->input('ozellik'),
        ]);
        return redirect()->route('aracTuru')->with('success', 'Özellik  Başarıyla Eklendi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.'.$th);


        }

    }
    public function ozellikDestroy(Request $request)
    {
        try {
        // Özelliği bul
            $id = $request->ozellik_id;
            $ozellik = AracOzellik::find($id);

            if ($ozellik) {
                // Özelliği sil
                $ozellik->delete();

                return redirect()->route('aracTuru')->with('success', 'Özellik  Başarıyla Silindi');

            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.'.$th);


        }

    }
}
