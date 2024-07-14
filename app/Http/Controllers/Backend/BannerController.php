<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BannerController extends Controller
{
    public function AllBanner()
    {

        $banner = Banner::latest()->get();
        return view('backend.banner.all_banner', compact('banner'));
    } // End Method

    public function AddBanner()
    {
        return view('backend.banner.add_banner');
    } // End Method

    public function StoreBanner(Request $request)
    {
        if ($request->file('image')) {
            $takeimg = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '_' . $takeimg->getClientOriginalExtension();
            $img = $manager->read($takeimg);
            $img = $img->resize(1920, 600);
            $img->toJpeg(80)->save(base_path('public/upload/banner/' . $name_gen));
            $save_url = 'upload/banner/' . $name_gen;

            Banner::insert([

                'heading' => $request->heading,
                'sub_heading' => $request->subheading,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Banner Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);
    } // End Method
}
