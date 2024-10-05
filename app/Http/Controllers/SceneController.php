<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scene;
use App\Models\Story;
use Illuminate\Support\Facades\Storage;

class SceneController extends Controller
{
    // Fungsi Admin untuk menampilkan semua scene
    public function index()
    {
        // Ambil semua data dari t_scene_story beserta relasinya
        $t_scene_story = Scene::all();
    
        return view('scene.scene', compact('t_scene_story'));

        // Ambil semua data dari m_story untuk dropdown
        $m_story = Story::all();

        return view('scene.scene', compact('scenes', 'm_story'));
    }

    // Menampilkan form pembuatan scene
    public function create()
{
    // Ambil semua story untuk dropdown
    $m_story = Story::all();

    // Ambil semua scene untuk ditampilkan
    $scenes = Scene::with('story')->get(); // Menambahkan ini

    return view('scene.create_scene', compact('m_story', 'scenes')); // Mengirimkan variabel scenes
}

    
    // Menyimpan data scene
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

        return redirect()->route('scene.index')->with('success', 'Berhasil Menyimpan Data');
    }

    // Menampilkan form edit scene
    public function edit($scene_story_id)
    {
        $scene = Scene::findOrFail($scene_story_id);
        $m_story = Story::all();

        return view('scene.edit_scene', compact('scene', 'm_story'));
    }

    // Mengupdate data scene
    public function update(Request $request, $scene_story_id)
    {
        $request->validate([
            'story_id' => 'required|numeric',
            'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'narasi' => 'nullable|string',
            'voice_over' => 'nullable|mimes:mp3,wav,aac|max:10240',
            'order'  => 'required|numeric',
        ]);

        $scene = Scene::findOrFail($scene_story_id);

        // Cek jika ada file foto yang baru diupload
        $fotoPath = $scene->picture; // Simpan foto lama sebagai default
        if ($request->hasFile('picture')) {
            // Hapus foto lama jika ada
            if ($scene->picture) {
                Storage::disk('public')->delete($scene->picture);
            }

            // Simpan foto baru
            $fotoPath = $request->file('picture')->store('scene', 'public');
        }

        // Cek jika ada file voice over yang baru diupload
        $voicePath = $scene->voice_over; // Simpan voice lama sebagai default
        if ($request->hasFile('voice_over')) {
            // Hapus voice lama jika ada
            if ($scene->voice_over) {
                Storage::disk('public')->delete($scene->voice_over);
            }

            // Simpan voice baru
            $voicePath = $request->file('voice_over')->store('voice', 'public');
        }

        // Update data ke database
        $scene->update([
            'story_id' => $request->story_id,
            'picture' => $fotoPath,
            'narasi' => $request->narasi,
            'voice_over' => $voicePath,
            'order' => $request->order,
        ]);

        return redirect()->route('story.detail_story', ['story_id' => $request->story_id])->with('success', 'Berhasil Mengupdate Data');
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
        $scene->delete();

        return redirect()->route('scene.index')->with('success', 'Berhasil Menghapus Data');
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
    

}
