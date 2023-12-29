<?php

namespace App\Http\Controllers;

use App\Models\AracTuru;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Toastr;
use App\Models\Konum;
use App\Models\Slide;
use App\Models\Transfer;
use App\Models\Yorum;
use Illuminate\Support\Facades\Auth;
use Throwable;

class IndexController extends Controller
{
    public function index() {
    $slides = Slide::all();
    $konums = Konum::all();
    $yorums = Yorum::with('user')->paginate(10);
    $araclar = AracTuru::all()->load(['ozellikler','transfer']);
    $portfolios = Portfolio::all()->load('category');
    $categories = PortfolioCategory::all();
    return view('layouts.frontend.welcome',compact(['slides','araclar','portfolios','categories','konums','yorums']));
    }

    public function aracSecimi(Request $request){
        $validatedData = $request->validate([
            'nereden_id' => 'required',
            'nereye_id' => 'required',
            'date' => 'required|date',
            'parabirimi' => 'required',
            ]);

            if($request->date < date("Y/m/d")){
                return redirect()->back()->with('error','Yanlış Tarih Girdiniz.');
            }
            $neredenId = $request->input('nereden_id');
            $nereyeId = $request->input('nereye_id');
            $kisi = $request->input('yetiskin') + $request->input('cocuk');
    // Belirli nereden_id ve nereye_id değerlerine sahip olan Transfer kayıtlarını al
    $transfers = Transfer::where('nereden_id', $neredenId)
    ->where('nereye_id', $nereyeId)
    ->whereHas('aracTur', function ($query) use ($kisi) {
        $query->where('koltuk_sayisi', '>=', $kisi);
    })
    ->get();
    foreach($transfers as $transfer){


        $transfer->fiyat = ceil(TCMB_Converter($request->parabirimi,'EUR',$transfer->fiyat));


        if (Auth::check()) {
            $user = Auth::user();

            // Kullanıcıya ait indirimleri al
           $discounts = $user->kupon->first();
            if($discounts){
                $yeniFiyat = ($transfer->fiyat - ($transfer->fiyat * $discounts->indirimYuzde /100));
                $transfer->eskiFiyat = $transfer->fiyat;
                $transfer->fiyat = $yeniFiyat;
                $transfer->kuponId = $discounts->id;
            }
        }
    }
            $slides = Slide::all();



        return view('layouts.frontend.transfer',compact(['slides','transfers','request']));

    }




}

function TCMB_Converter($from = 'EUR', $to = 'USD', $val = 1)
{
    // Sistemimizde Simplexml ve Curl fonksiyonları var mı kontrol ediyoruz.
    if (!function_exists('simplexml_load_string') || !function_exists('curl_init')) {
        return 'Simplexml extension missing.';
    }

    // Başlangıç için nereden/nereye değerlerini 1 yapıyoruz çünkü TRY'nin bir karşılığı yok.
    $CurrencyData = [
        'from' => 1,
        'to' => 1
    ];

    // XML verisini curl ile alıyoruz, hata var mı yok mu diye try/catch bloklarına alıyoruz.
    try {
        $tcmbMirror = 'https://www.tcmb.gov.tr/kurlar/today.xml';
        $curl = curl_init($tcmbMirror);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $tcmbMirror);

        $dataFromtcmb = curl_exec($curl);
    } catch (Throwable $e) {
        echo 'Unhandled exception, maybe from cURL' . $e->getMessage();
        return 0;
    }

    // XML verisini SimpleXML'e aktararak bir class haline getiriyoruz.
    $Currencies = simplexml_load_string($dataFromtcmb);

    // Bütün verileri foreach ile gezerek arıyoruz ve nereden/nereye değerlerimize eşitliyoruz.
    foreach ($Currencies->Currency as $Currency) {
        if ($from == $Currency['CurrencyCode']) $CurrencyData['from'] = $Currency->BanknoteSelling;
        if ($to == $Currency['CurrencyCode']) $CurrencyData['to'] = $Currency->BanknoteSelling;
    }

    // Hesaplama işlemini yaparak return ediyoruz.
    return round(($CurrencyData['to'] / $CurrencyData['from']) * $val, 10);
}
