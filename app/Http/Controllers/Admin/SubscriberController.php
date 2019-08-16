<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers',
        ]);
        $subscriber=new Subscriber();
        $subscriber->email=$request->email;
        $subscriber->save();
        Toastr::success("Вы подписаны", 'Успех');

        return redirect()->route('home');
    }

    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber', compact('subscribers'));
    }


    public function destroy($id)
    {
        $subscriber=Subscriber::findOrFail($id);
        $subscriber->delete();
        Toastr::success('Подписчик удален!','Успех');
        return redirect()->back();

    }
}
