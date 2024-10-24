<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story; 
use App\Models\Scene; 
use App\Models\AssesmentMultiple; 
use App\Models\TrueFalse; 
use App\Models\Matching; 
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    
    public function index(Request $request)
    {
        $m_story = Story::all();

        // If the request is for an API, return a JSON response
        if ($request->expectsJson()) {
            return response()->json($m_story);
        }

        // Otherwise, return the view for web requests
        return view('story.story', compact('m_story'));
    }
    
    public function create(){
            
        $response = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
            $provinces = json_decode($response, true);
            
            $provinceList = [];
            foreach ($provinces['provinsi'] as $province) {
                $provinceList[] = [
                    'id' => $province['id'],
                    'name' => $province['nama']
                ];
            }

            return view('story.create_story', compact('provinceList'));
        }



    /**
     * Store a newly created story in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'province' => 'nullable|string|max:50',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('story', 'public');
        } else {
            $coverPath = null;
        }

        $story = Story::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'province' => $request->province,
            'cover' => $coverPath,
            'status' => $request->status,
        ]);

        if ($request->expectsJson()) {
            return response()->json($story, 201);
        }

        return redirect()->route('story.index')->with('success', 'Berhasil Menyimpan Data');
    }


    
    public function edit($story_id)
    {
    // Mengambil data story berdasarkan id
    $story = Story::findOrFail($story_id);
    
    // Mengambil daftar provinsi untuk dropdown
    $response = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
    $provinces = json_decode($response, true);
    
    $provinceList = [];
    foreach ($provinces['provinsi'] as $province) {
        $provinceList[] = [
            'id' => $province['id'],
            'name' => $province['nama']
        ];
    }

    // Mengirim data ke view
    return view('story.edit_story', compact('story', 'provinceList'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'province' => 'nullable|string|max:50',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'status' => 'required|boolean',
        ]);

        $story = Story::findOrFail($id);

        if ($request->hasFile('cover')) {
            if ($story->cover) {
                Storage::disk('public')->delete($story->cover);
            }
            $coverPath = $request->file('cover')->store('story', 'public');
        } else {
            $coverPath = $story->cover;
        }

        $story->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'province' => $request->province,
            'cover' => $coverPath,
            'status' => $request->status,
        ]);

        if ($request->expectsJson()) {
            return response()->json($story, 200);
        }

        return redirect()->route('story.index')->with('success', 'Berhasil Mengupdate Data');
    }


    public function destroy(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        if ($story->cover) {
            Storage::disk('public')->delete($story->cover);
        }

        $story->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Story deleted successfully'], 200);
        }

        return redirect()->route('story.index')->with('success', 'Berhasil Menghapus Data');
    }


    public function detail($story_id)
    {
        // Mengambil data story berdasarkan id
        $story = Story::findOrFail($story_id);

        // Mengirim data ke view
        return view('story.detail', compact('story'));
    }

    public function show(Request $request, $id)
    {
        $story = Story::findOrFail($id);
        
        if ($request->expectsJson()) {
            return response()->json($story);
        }

        $scenes = Scene::where('story_id', $id)->get();
        $multipleChoices = AssesmentMultiple::where('story_id', $id)->get();
        $trueFalseQuestions = TrueFalse::where('story_id', $id)->get();
        $matching = Matching::where('story_id', $id)->first();

        return view('story.detail_story', compact('story', 'scenes', 'multipleChoices', 'trueFalseQuestions', 'matching'));
    }


        public function createScene($story_id)
        {
            // Mengambil data story berdasarkan id
            $story = Story::findOrFail($story_id);
            
            // Mengambil daftar provinsi untuk dropdown (jika diperlukan)
            $response = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
            $provinces = json_decode($response, true);
            
            $provinceList = [];
            foreach ($provinces['provinsi'] as $province) {
                $provinceList[] = [
                    'id' => $province['id'],
                    'name' => $province['nama']
                ];
            }

            // Mengirim data ke view
            return view('story.create_scene', compact('story', 'provinceList'));
        }


            }



