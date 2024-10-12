<?php

namespace App\Http\Controllers;

use App\Models\Matching;
use App\Models\Story;
use Illuminate\Http\Request;

class MatchingController extends Controller
{
    // Display all matching assessments
    public function index()
    {
        $t_assesment_matching = Matching::with('story')->get();

        return view('matching.matching', compact('t_assesment_matching'));
    }

    // Show the form for creating a new matching assessment
    public function create(Request $request)
    {
        // Get story_id from query parameter
        $storyId = $request->query('story_id');
        $story = Story::findOrFail($storyId); 
    
        return view('matching.create_matching', compact('story'));
    }

    // Store a newly created matching assessment
    public function store(Request $request)
    {
        $request->validate([
            'story_id'  => 'required|exists:m_story,story_id', // Validation for existing story ID
            'picture_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'picture_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name_1'    => 'required|string|max:255',
            'name_2'    => 'required|string|max:255',
            'name_3'    => 'required|string|max:255',
        ]);

        $data = $request->all();

        // Store the images if they are uploaded
        if ($request->hasFile('picture_1')) {
            $data['picture_1'] = $request->file('picture_1')->store('matching', 'public');
        }
        if ($request->hasFile('picture_2')) {
            $data['picture_2'] = $request->file('picture_2')->store('matching', 'public');
        }
        if ($request->hasFile('picture_3')) {
            $data['picture_3'] = $request->file('picture_3')->store('matching', 'public');
        }

        // Save the matching assessment
        Matching::create($data);

        // Redirect back to the story detail page
        return redirect()->route('story.detail', ['story_id' => $request->story_id])
                         ->withFragment('matching')
                         ->with('success', 'Matching assessment created successfully.');
    }

    // Show the form for editing a matching assessment
    public function edit(string $id_asses)
{
    $matching = Matching::findOrFail($id_asses);
    $story = $matching->story; // Assuming there is a relationship between Matching and Story
    $stories = Story::all();

    return view('matching.edit_matching', compact('matching', 'story', 'stories')); 
}


    // Update the matching assessment
    public function update(Request $request, $id_asses)
{
    $matching = Matching::findOrFail($id_asses);

    // Validate input
    $request->validate([
        'name_1' => 'required|string|max:255',
        'name_2' => 'required|string|max:255',
        'name_3' => 'required|string|max:255',
        'picture_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'picture_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'picture_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle file upload for picture_1
    if ($request->hasFile('picture_1')) {
        $picture1Path = $request->file('picture_1')->store('images', 'public');
        $matching->picture_1 = $picture1Path;
    }

    // Handle file upload for picture_2
    if ($request->hasFile('picture_2')) {
        $picture2Path = $request->file('picture_2')->store('images', 'public');
        $matching->picture_2 = $picture2Path;
    }

    // Handle file upload for picture_3
    if ($request->hasFile('picture_3')) {
        $picture3Path = $request->file('picture_3')->store('images', 'public');
        $matching->picture_3 = $picture3Path;
    }

    // Update names
    $matching->name_1 = $request->name_1;
    $matching->name_2 = $request->name_2;
    $matching->name_3 = $request->name_3;

    // Save changes
    $matching->save();

    return redirect()->route('story.detail', ['story_id' => $matching->story_id])
                     ->with('success', 'Matching question updated successfully.')
                     ->withFragment('matching');
}


    // Delete the matching assessment
    public function destroy(string $id_asses)
    {
        $assessment = Matching::findOrFail($id_asses);
        $storyId = $assessment->story_id;

        $assessment->delete();

        return redirect()->route('story.detail', ['story_id' => $storyId])
        ->withFragment('matching')
                         ->with('success', 'Matching assessment deleted successfully.');
    }
}
