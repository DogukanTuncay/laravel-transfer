<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Yoeunes\Toastr\Toastr;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::paginate(10);
        return view('layouts.admin.slides.index', compact('slides'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $filename = 'assets/images/slide/'.now()->timestamp . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/slide'), $filename);
            Slide::create([
                'image_url' => $filename,
            ]);

            return redirect()->route('slider')->with('success', 'Slide created successfully');
            }
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Error uploading image');
        }



    }
    public function update(Request $request, $id)
    {
        try {
             $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slide = Slide::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slide_images');
            $slide->image = $imagePath;
        }

        $slide->title = $validatedData['title'];
        $slide->save();

        return redirect()->route('slider')->with('success', 'Slide updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.'.$th);

        }

    }

    public function destroy($id)
{
    try {
        $slide = Slide::findOrFail($id);
        $slide->delete();

        return redirect()->route('slider')->with('success', 'Slide deleted successfully');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.'.$th);

    }
    return redirect()->back()->with('error','Bir hata oluştu. Lütfen Tekrar Deneyiniz, eğer sorun sürekli gerçekleşirse desteğe ulaşın.');

}


}
