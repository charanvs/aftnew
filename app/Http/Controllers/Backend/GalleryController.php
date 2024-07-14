<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    public function index()
    {

        $gallery = Gallery::latest()->get();
        return view('backend.gallery.all_gallery', compact('gallery'));
    } // End Method

    public function AddGallery()
    {
        return view('backend.gallery.add_gallery');
    } // End Method

    public function StoreGallery(Request $request)
    {
        if ($request->file('image')) {
            $takeimg = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '_' . $takeimg->getClientOriginalExtension();
            $img = $manager->read($takeimg);
            $img = $img->resize(550, 450);
            $img->toJpeg(80)->save(base_path('public/upload/gallery/' . $name_gen));
            $save_url = 'upload/gallery/' . $name_gen;

            Gallery::insert([

                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $request->thumbnail,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }



        $notification = array(
            'message' => 'Gallery Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.gallery')->with($notification);
    } // End Method

    public function EditGallery($id)
    {

        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit_gallery', compact('gallery'));
    } // End Method


    // public function UpdateTeam(Request $request)
    // {

    //     $team_id = $request->id;

    //     if ($request->file('image')) {

    //         $takeimg = $request->file('image');
    //         $manager = new ImageManager(new Driver());
    //         $name_gen = hexdec(uniqid()) . '_' . $takeimg->getClientOriginalExtension();
    //         $img = $manager->read($takeimg);
    //         $img = $img->resize(550, 670);
    //         $img->toJpeg(80)->save(base_path('public/upload/team/' . $name_gen));
    //         $save_url = 'upload/team/' . $name_gen;

    //         Team::findOrFail($team_id)->update([

    //             'name' => $request->name,
    //             'salutation' => $request->postion,
    //             'facebook' => $request->facebook,
    //             'image' => $save_url,
    //             'created_at' => Carbon::now(),
    //         ]);

    //         $notification = array(
    //             'message' => 'Team Updated With Image Successfully',
    //             'alert-type' => 'success'
    //         );

    //         return redirect()->route('all.team')->with($notification);
    //     } else {

    //         Team::findOrFail($team_id)->update([

    //             'name' => $request->name,
    //             'salutation' => $request->postion,
    //             'facebook' => $request->facebook,
    //             'created_at' => Carbon::now(),
    //         ]);

    //         $notification = array(
    //             'message' => 'Team Updated Without Image Successfully',
    //             'alert-type' => 'success'
    //         );

    //         return redirect()->route('all.team')->with($notification);
    //     } // End Else


    // } // End Method
}
