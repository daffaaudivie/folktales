<?php

namespace App\Http\Controllers;

use App\Models\Matching;
use App\Models\Story;
use App\Models\AssesmentMultiple;
use App\Models\Scene;
use App\Models\TrueFalse;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the count of records from each table
        $storyCount = Story::count();
        $sceneCount = Scene::count();
        $matchingCount = Matching::count();
        $multipleCount = AssesmentMultiple::count();
        $tfCount = TrueFalse::count();

        return view('dashboard', compact('storyCount', 'sceneCount', 'matchingCount', 'multipleCount', 'tfCount'));
    }
}
