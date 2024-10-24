<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scene;
use App\Models\Story;
use Illuminate\Support\Facades\Storage;

class SceneController extends Controller
{

    public function index()
    {
    
        if (request()->wantsJson()) {
            $scenes = Scene::all();
            return response()->json([
                'status' => 'success',
                'data' => $scenes
            ]);
        }
        $t_scene_story = Scene::all();
        return view('scene.scene', compact('t_scene_story'));
    }

    public function create(Request $request)
    {
        $storyId = $request->query('story_id');
        $story = Story::findOrFail($storyId); 
    
        return view('scene.create_scene', compact('story'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'story_id' => 'required|numeric',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'narasi' => 'nullable|string',
            'voice_over' => 'nullable|mimes:mp3,wav,aac|max:10240',
            'order'  => 'required|numeric',
        ]);

        // Proses upload foto
        $fotoPath = $request->hasFile('picture') ? $request->file('picture')->store('scene', 'public') : null;

        // Proses upload voice over
        $voicePath = $request->hasFile('voice_over') ? $request->file('voice_over')->store('voice', 'public') : null;

        // Simpan data ke database
        Scene::create([
            'story_id' => $request->story_id,
            'picture' => $fotoPath,
            'narasi' => $request->narasi,
            'voice_over' => $voicePath,
            'order' => $request->order,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Scene created successfully',
                'data' => $scene
            ], 201);
        }

        // Jika bukan API, return redirect seperti biasa
        return redirect()->route('story.detail', ['story_id' => $request->story_id])
                        ->withFragment('scene')
                        ->with('success', 'Assessment created successfully.');
    }

    // Menampilkan form edit scene
    public function edit($scene_story_id)
    {
        $scene = Scene::findOrFail($scene_story_id);
        $m_story = Story::all();

        return view('scene.edit_scene', compact('scene', 'm_story'));
    }

    // Mengupdate data scene
    public function update(Request $request, string $scene_story_id)
{
    $request->validate([
        'story_id' => 'nullable|exists:m_story,story_id',
        'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'narasi' => 'nullable|string',
        'voice_over' => 'nullable|mimes:mp3,wav,aac|max:10240',
        'order' => 'required|numeric',
    ]);

    // Find the scene based on the provided ID
    $scene = Scene::findOrFail($scene_story_id);

    // Store the old file paths
    $fotoPath = $scene->picture;
    $voicePath = $scene->voice_over;

    // Handle picture upload
    if ($request->hasFile('picture')) {
        if ($scene->picture) {
            Storage::disk('public')->delete($scene->picture);
        }
        $fotoPath = $request->file('picture')->store('scene', 'public');
    }

    // Handle voice over upload
    if ($request->hasFile('voice_over')) {
        if ($scene->voice_over) {
            Storage::disk('public')->delete($scene->voice_over);
        }
        $voicePath = $request->file('voice_over')->store('voice', 'public');
    }

    // Update scene data
    $scene->update([
        'picture' => $fotoPath,
        'narasi' => $request->narasi,
        'voice_over' => $voicePath,
        'order' => $request->order,
    ]);

    $storyId = $scene->story_id;

    // Update data assessment
    $scene->update($request->all());

    if ($request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Scene updated successfully',
            'data' => $scene
        ]);
    }

    return redirect()->route('story.detail', ['story_id' => $scene->story_id])
                 ->with('success', 'Assessment edited successfully.')
                 ->withFragment('scene');
}


    // Menghapus data scene
    public function destroy($scene_story_id)
    {
        $scene = Scene::findOrFail($scene_story_id);

        // Hapus foto dari storage jika ada
        if ($scene->picture) {
            Storage::disk('public')->delete($scene->picture);
        }

        // Hapus voice over dari storage jika ada
        if ($scene->voice_over) {
            Storage::disk('public')->delete($scene->voice_over);
        }

        // Hapus data dari database
        $storyId = $scene->story_id;

        // Hapus data assessment
        $scene->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Scene deleted successfully'
            ]);
        }
        return redirect()->route('story.detail', ['story_id' => $storyId])
                        ->with('success', 'Assessment deleted successfully.')
                        ->withFragment('scene');
    }


    public function detail($story_id)
    {
        // Ambil story berdasarkan ID
        $story = Story::findOrFail($story_id);
    
        // Ambil semua scene yang terkait dengan story ini
        $t_scene_story = Scene::where('story_id', $story_id)->get();
    
        // Kembalikan view dengan variabel story dan t_scene_story
        return view('story.detail_story', compact('story', 't_scene_story'));
    }

    public function getScenesByStory($storyId)
    {
        try {
            $scenes = Scene::where('story_id', $storyId)->get();
            return response()->json([
                'status' => 'success',
                'data' => $scenes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving scenes'
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $scene = Scene::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $scene
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Scene not found'
            ], 404);
        }
    }

    public function showAssessmentDetail($story_id)
    {
        // Ambil story berdasarkan ID
        $story = Story::findOrFail($story_id);

        // Ambil semua assessment yang terkait dengan story ini
        $t_scene_story = Scene::where('story_id', $story_id)->get();

        return view('story.detail_story', compact('story', 't_scene_story', 'scenes', 'multipleChoices'));
    }
        

}