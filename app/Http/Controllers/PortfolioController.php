<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Toastr;

class PortfolioController extends Controller
{
     // Portföy listeleme
     public function index()
     {
         $portfolios = Portfolio::with('category')->paginate(10);
         $categories = PortfolioCategory::all();
         return view('layouts.admin.portfoy.index', compact('portfolios','categories'));
     }

     // Portföy oluşturma
     public function store(Request $request)
     {
        try {
            $validatedData = $request->validate([
                'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $filename = 'assets/images/portfoy/'.now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/portfoy'), $filename);
            $portfolio = Portfolio::create([
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'image_url' =>  $filename, // Dosya yolunu veritabanına kaydet
            ]);
            return redirect()->route('portfoy')->with('success', 'Resim Başarıyla Oluşturuldu');
            }
        }catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Error uploading image:'.$th);
        }
     }
     // Portföy silme
     public function destroy($id)
     {
        try{
            $portfolio = Portfolio::find($id);
            if ($portfolio) {

                $portfolio->delete();

                return redirect()->route('portfoy')->with('success','Resim Başarıyla Silindi');
            }
        } catch(\Throwable $th){
            return back()->withInput()->with('error', 'Resmi Silerken hata oldu:'.$th);

         }
         return back()->withInput()->with('error', 'Resmi Silerken hata oldu.');
     }

     // Kategori oluşturma
     public function categoryStore(Request $request)
     {
        try{
            $category = PortfolioCategory::create([
                'name' => $request->input('name'),
            ]);
            return redirect()->back()->with('success', 'Kategori Başarıyla Oluşturuldu');
        }
        catch (\Throwable $th){
            return back()->withInput()->with('error', 'Kategori Oluşturulurken Hata Oldu:'.$th);
        }

     }

     // Kategori silme
     public function categoryDestroy($id)
     {
        try{
            $category = PortfolioCategory::find($id);
            if ($category) {
                $category->delete();
                return redirect()->route('portfoy')->with('success', 'Kategori Başarıyla Silindi');

            }
            return back()->withInput()->with('error', 'Kategori Silinirken Hata Oldu.');

        } catch(\Throwable $th){
            return back()->withInput()->with('error', 'Kategori Silinirken Hata Oldu:'.$th);
        }

     }
}
