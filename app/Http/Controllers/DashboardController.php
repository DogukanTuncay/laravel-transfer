<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transfer;
use Yoeunes\Toastr\Toastr;

class DashboardController extends Controller
{
    public function index() {
        return view('layouts.admin.dashboard');
    }



    public function store(Request $request) {
        $validatedData = $request->validate([
            'nereden_id' => 'required|exists:konum,id',
            'nereye_id' => 'required|exists:konum,id',
            'fiyat' => 'required|numeric',
            'yetiskin_sayisi' => 'required|numeric',
            'cocuk_sayisi' => 'required|numeric',
            'date' => 'required|date',
            'para_birimi' => 'required|string',
            'arac_tur_id' => 'required|exists:arac_tur,id',
        ]);
        $transfer = Transfer::create($validatedData);
        if ($transfer) {
            $message = __('user.success');
            toastr()->success($message);
            return view('layouts.frontend.welcome');
        } else {
            $message = __('user.error');
            toastr()->error($message);
            return view('layouts.frontend.welcome');

        }
    }
}
