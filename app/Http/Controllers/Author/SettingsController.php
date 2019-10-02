<?php

namespace App\Http\Controllers\Author;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('author.settings');
    }


    public function updateProfile(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);

        $user = User::findOrFail(Auth::id());
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {

            //уникальное имя для изображения
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentData . '-' . uniqid() . '-' . $image->getClientOriginalName();

            //проверка директории
            if (!Storage::disk('public')->exists('post')) {

                Storage::disk('public')->makeDirectory('profile');
            }
            if (Storage::disk('public')->exists('profile/' . $user->img)) {

                Storage::disk('public')->delete('profile/' . $user->img);
            }
            //resize image
            $profileImg = Image::make($image)->resize(500, 500)->save($imagename, 90);
            Storage::disk('public')->put('profile/' . $imagename, $profileImg);

        } else {
            $imagename = $user->img;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->img = $imagename;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Профиль успешно обнавлен');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassworsd = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassworsd)) {

            if (!Hash::check($request->password, $hashedPassworsd)) {

                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                $password = bcrypt('my-secret-password');

                Toastr::success('Пароль успешно обновлен', 'Успех');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::success('Пароли не совпадают', 'Ошибка');
            }
        } else {
            Toastr::success('Неверный пароль', 'Ошибка');
        }
    }

}
