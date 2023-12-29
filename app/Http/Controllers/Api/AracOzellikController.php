<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AracTuru;
class AracOzellikController extends Controller
{
    public function getAracOzellikData(Request $request){
        $aracId = $request->input('arac_id'); // İstemciden araç ID'sini al

        // Aracı bul ve ona ait özellikleri al
        $arac = AracTuru::find($aracId);

        if ($arac) {
            $ozellikler = $arac->ozellikler()->get(); // Araca ait özellikleri al

            return response()->json($ozellikler); // JSON olarak özellikleri döndür
        }

        return response()->json(['message' => 'Araç bulunamadı'], 404);
    }
}
