<?php

namespace App\Http\Controllers;

use App\Models\CaseRegistration;
use App\Models\NewRecord;
use App\Models\Team;
use App\Models\Bench;
use App\Models\Vacancy;
use App\Models\Gallery;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CaseDependency;
use App\Models\InterimJudgement;
use App\Models\Event;

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
        $new_records = NewRecord::all();


        $totalCases = DB::table('case_registrations')->count() + DB::table('judgements')->count();
        $pending = DB::table('case_registrations')->count();
        $disposed = DB::table('disposeds')->count();
        return view('frontend.home.index', compact('data', 'totalCases', 'pending', 'disposed', 'bench', 'gallery', 'new_records'));
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

    public function Gallery()
    {
        $data = Gallery::all();
        return view('frontend.gallery', compact('data'));
    }

    public function Rules()
    {
        $data = Rule::all();
        return view('frontend.acts_rules', compact('data'));
    }

    public function OrganizationChart()
    {
        return view('frontend.org.organization');
    }

    public function TendersNotifications()
    {
        $items = NewRecord::paginate(10);
        return view('frontend.pages.tenders_notifications', compact('items'));
    }

    public function NewCalendar() {
         // Fetch events from the database
    $events = Event::select('title', 'start', 'category')->get();

    // Separate events into different categories
    $holidays = $events->where('category', 'Holiday')->values(); // Use `values()` to reindex the collection
    $causelist = $events->where('category', 'Cause List')->values();
    $courtHolidays = $events->where('category', 'Court Holiday')->values();

    // Pass categorized events to the Blade view
    return view('frontend.calendar.old_aft_calendar', compact('holidays', 'causelist', 'courtHolidays'));
    }
}
