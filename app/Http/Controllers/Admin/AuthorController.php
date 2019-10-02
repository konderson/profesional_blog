<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::authors()
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favorite_posts')
            ->get();

        return view('admin.author', compact('authors'));
    }


    public function destroy($id)
    {
        $author = User::find($id);
        $author->delete();
        Toastr::success('Автор успешно удален','Success');
        return redirect()->back();


    }
}
