<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    //
    public function client()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function add_client()
    {
        return view('admin.client.add');
    }

    public function store_client(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $request->validate([
            "image"  => "required|mimes:jpg,jpeg,png",
            "url"  => "regex:" . $regex,
        ]);

        $client = new Client();
        if($request->hasFile('image')){
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $image = time().rand().'.'.$extension;
          $file->move('assets/front/img/',$image);

          $client->image = $image;
        }

        $client->url = $request->url;
        $client->save();


        $notification = array(
            'messege' => 'Client Added Successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.client'))->with('notification', $notification);
    }

    public function edit_client($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    public function update_client(Request $request , $id)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $request->validate([
            "image"  => "mimes:jpg,jpeg,png",
            "url"  => "regex:" . $regex,
        ]);


        $client = Client::findOrFail($id);

        if($request->hasFile('image')){
            @unlink('assets/front/img'.$client->image);

          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $image = time().rand().'.'.$extension;
          $file->move('assets/front/img/',$image);

          $client->image = $image;
        }
        $client->url = $request->url;
        $client->save();


        $notification = array(
            'messege' => 'Client Updated Successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.client'))->with('notification', $notification);
    }

    public function delete_client($id)
    {
        $client = Client::findOrFail($id);
        @unlink('assets/front/img/'.$client->image);
        $client->delete();

        $notification = array(
            'messege' => 'Client Deleted Successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.client'))->with('notification', $notification);
    }
}
