<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorPost;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categories', 'tags'));
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
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',

        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {

            //уникальное имя для изображения
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentData . '-' . uniqid() . '-' . $image->getClientOriginalName();

            //проверка директории
            if (!Storage::disk('public')->exists('post')) {

                Storage::disk('public')->makeDirectory('post');
            }
            //resize image
            $postImg = Image::make($image)->resize(1600, 1066)->save($imagename, 90);
            Storage::disk('public')->put('post/' . $imagename, $postImg);

        } else {
            $imagename = "default.png";
        }

        $post = new Post();
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->body = $request->body;
        $post->slug = $slug;
        $post->image = $imagename;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorPost($post));
        Toastr::success("Новая статья успешно создана", 'Успех');

        return redirect()->route('author.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            Toastr::error("У вас нет прав на просмортр данной статьи.");
            return redirect()->back();
        }
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id != Auth::id()) {
            Toastr::error("У вас нет прав на редактировании данной статьи.");
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,bmp,png,jpg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',

        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {

            //уникальное имя для изображения
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentData . '-' . uniqid() . '-' . $image->getClientOriginalName();

            //проверка директории
            if (!Storage::disk('public')->exists('post')) {

                Storage::disk('public')->makeDirectory('post');
            }
            //resize image
            $postImg = Image::make($image)->resize(1600, 1066)->save($imagename, 90);
            Storage::disk('public')->put('post/' . $imagename, $postImg);

            if (Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }

        } else {
            $imagename = $post->image;
        }


        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->body = $request->body;
        $post->slug = $slug;
        $post->image = $imagename;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success(" Статья успешно обнавлена", 'Успех');

        return redirect()->route('admin.post.index');

    }


    public function edit(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            Toastr::error("У вас нет прав на редактирование данной статьи.");
            return redirect()->back();
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit',compact('tags','categories','post'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            Toastr::error("У вас нет прав на удаление данной статьи.");
            return redirect()->back();
        }
        if (Storage::disk('public')->exists('post/' . $post->image)) {
            Storage::disk('public')->delete('post/' . $post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Статья удалена с сайта','Успех');
        return redirect()->route('author.post.index');
    }
}
