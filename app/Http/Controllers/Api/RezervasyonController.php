<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezervasyon;
class RezervasyonController extends Controller
{
    public function index(){
        $data = Rezervasyon::with(['nereden','nereye','aracTur'])->get();


        return response()->json($data);
    }

}
