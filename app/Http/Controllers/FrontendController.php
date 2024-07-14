<?php

namespace App\Http\Controllers;

use App\Models\CaseRegistration;
use App\Models\Team;
use App\Models\Bench;
use App\Models\Vacancy;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function HomeTest()
    {
        return view('frontend.index');
    }

    public function Home()
    {
        $data = Team::all();
        $bench = Bench::all();
        $gallery = Gallery::all();


        $totalCases = DB::table('case_registrations')->count() + DB::table('judgements')->count();
        $pending = DB::table('case_registrations')->count();
        $disposed = DB::table('disposeds')->count();
        return view('frontend.home.index', compact('data', 'totalCases', 'pending', 'disposed', 'bench', 'gallery'));
    }
    public function Members()
    {
        $data = Team::where('id', '>', '2')->get();
        $chair = Team::where('id', '1')->first();
        $second = Team::where('id', '2')->first();

        return view('frontend.team', compact('data', 'chair', 'second'));
    }
    public function DailyCauseList()
    {
        return view('frontend.calendar');
    }
    public function Vacancies()
    {
        $data = Vacancy::all();
        return view('frontend.recruitment', compact('data'));
    }

    public function OrganizationChart()
    {
        return view('frontend.org.organization');
    }
}
