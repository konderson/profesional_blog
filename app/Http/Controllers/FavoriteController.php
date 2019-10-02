<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($post)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_posts()->where('post_id', $post)->count();
        if ($isFavorite == 0) {
            $user->favorite_posts()->attach($post);
            Toastr::success('Статья добавлена в список понравившихся :)', 'Успех');
            return redirect()->back();
        } else {
            $user->favorite_posts()->detach($post);
            Toastr::success('Статья удалена из списка понравившихся ', 'Успех');
            return redirect()->back();
        }
    }
}
