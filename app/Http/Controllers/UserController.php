<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $users = User::where('isAdmin',0)->with('kupon')->paginate(10);

        return view('layouts.admin.user.index',compact(['users']));
    }

    public function destroy($id)
     {

        try{
            $user= User::find($id);
            if ($user) {

                $user->delete();
                return redirect()->route('users')->with('success', 'Kullanıcı Başarıyla Silindi');
            }

        } catch(\Throwable $th){
            return back()->withInput()->with('error', 'Kullanıcıyı silerken hata oldu:'.$th);

         }
         return back()->withInput()->with('error', 'Kullanıcıyı Silerken hata oldu.');
     }

}
