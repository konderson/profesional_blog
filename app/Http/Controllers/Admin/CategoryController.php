<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {

            //уникальное имя для изображения
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentData . '-' . uniqid() . '-' . $image->getClientOriginalName();

            //проверка директории
            if (!Storage::disk('public')->exists('category')) {

                Storage::disk('public')->makeDirectory('category');
            }
            //resize image
            $category = Image::make($image)->resize(1600, 479)->save($imagename, 90);
            Storage::disk('public')->put('category/' . $imagename, $category);

            if (!Storage::disk('public')->exists('category/slider')) {

                Storage::disk('public')->makeDirectory('category/slider');
            }
            $slider = Image::make($image)->resize(500, 333)->save($imagename, 90);;
            Storage::disk('public')->put('category/slider/' . $imagename, $slider);

        } else {
            $imagename = "default.png";
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->img = $imagename;
        $category->save();
        Toastr::success('Категория успешно создана', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',

        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category =Category::find($id);
        if (isset($image)) {

            //уникальное имя для изображения
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentData . '-' . uniqid() . '-' . $image->getClientOriginalName();

            //проверка директории
            if (!Storage::disk('public')->exists('category')) {

                Storage::disk('public')->makeDirectory('category');
            }
            if (Storage::disk('public')->exists('category/' . $category->img)) {

                Storage::disk('public')->delete('category/' . $category->img);
            }
            //resize image
            $category_img = Image::make($image)->resize(1600, 479)->save($imagename, 90);
            Storage::disk('public')->put('category/' . $imagename, $category_img);

            if (!Storage::disk('public')->exists('category/slider')) {

                Storage::disk('public')->makeDirectory('category/slider');
            }
            if (Storage::disk('public')->exists('category/slider' . $category->img)) {

                Storage::disk('public')->delete('category/slider' . $category->img);
            }
            $slider = Image::make($image)->resize(500, 333)->save($imagename, 90);;
            Storage::disk('public')->put('category/slider/' . $imagename, $slider);

        } else {
            $imagename = $category->img;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->img = $imagename;
        $category->save();
        Toastr::success('Категория успешно обнавлена', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if (Storage::disk('public')->exists('category/' . $category->img)) {

            Storage::disk('public')->delete('category/' . $category->img);

        }

        if (Storage::disk('public')->exists('category/slider/' . $category->img)) {

            Storage::disk('public')->delete('category/slider/' . $category->img);
        }
        $category->delete();
        Toastr::success('Категория успешно удалена','Успех');
        return redirect()->route('admin.category.index');

    }
}
