<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Bench;

class BenchController extends Controller
{
    public function AllBench()
    {

        $bench = Bench::latest()->get();
        return view('backend.bench.all_bench', compact('bench'));
    } // End Method

    public function AddBench()
    {
        return view('backend.bench.add_bench');
    } // End Method

    public function StoreBench(Request $request)
    {
        if ($request->file('image')) {
            $takeimg = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '_' . $takeimg->getClientOriginalExtension();
            $img = $manager->read($takeimg);
            $img = $img->resize(550, 450);
            $img->toJpeg(80)->save(base_path('public/upload/bench/' . $name_gen));
            $save_url = 'upload/bench/' . $name_gen;

            Bench::insert([

                'bench_name' => $request->name,
                'description' => $request->description,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Bench Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.bench')->with($notification);
    } // End Method

    // public function EditTeam($id)
    // {

    //     $team = Team::findOrFail($id);
    //     return view('backend.team.edit_team', compact('team'));
    // } // End Method


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
