<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Judgement;

class JudgementBackendController extends Controller
{
    public function AllJudgements() {
        $judgements = Judgement::all();
        return view('backend.judgement.all_judgements', compact('judgements'));
    }

    public function AddJudgement() {
        return view('backend.judgement.add_judgement');
    }
}
