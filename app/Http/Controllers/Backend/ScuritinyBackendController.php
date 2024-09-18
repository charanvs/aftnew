<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scrutiny;

class ScuritinyBackendController extends Controller
{
    public function AllDiary() {
        $allItems = Scrutiny::where('id', '>', 75000)->get();
        return view('backend.scuritiny.all_diary', compact('allItems'));
    }

    public function AddDiary() {
        return view('backend.scuritiny.add_diary');
    }
}
