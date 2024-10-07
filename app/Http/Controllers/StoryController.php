<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story; 
use App\Models\Scene; 
use App\Models\AssesmentMultiple; 
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    
    public function index()
    {
        // Mengambil semua data dari tabel m_story tanpa pagination dan search
        $m_story = Story::all();
    
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
    // Validasi input dari form
    $request->validate([
        'title' => 'required|string|max:255',
        'desc' => 'nullable|string',
        'province' => 'nullable|string|max:50', // Masih sama
        'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'required|boolean',
    ]);

    // Proses upload cover
    if ($request->hasFile('cover')) {
        $coverPath = $request->file('cover')->store('story', 'public'); // Perbaiki dari fotoPath menjadi coverPath
    } else {
        $coverPath = null; // Jika tidak ada file diupload, set null
    }

    // Simpan data ke database
    Story::create([
        'title' => $request->title,
        'desc' => $request->desc,
        'province' => $request->province, // Menggunakan nama provinsi
        'cover' => $coverPath, 
        'status' => $request->status,
    ]);

    return redirect()->route('story.index')->with('success', 'Berhasil Menyimpan Data');
}public function edit($story_id)
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


    public function update(Request $request, $story_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'province' => 'nullable|string|max:50',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'status' => 'required|boolean',
        ]);

        $story = Story::findOrFail($story_id);
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($story->cover) {
                Storage::disk('public')->delete($story->cover);
            }

            // Simpan cover baru
            $coverPath = $request->file('cover')->store('story', 'public');
        } else {
            $coverPath = $story->cover; // Jika tidak ada cover baru, simpan yang lama
        }

        // Update data ke database
        $story->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'province' => $request->province,
            'cover' => $coverPath,
            'status' => $request->status,
        ]);

        return redirect()->route('story.index')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy($story_id)
    {
        $story = Story::findOrFail($story_id);

        // Hapus cover dari storage jika ada
        if ($story->cover) {
            Storage::disk('public')->delete($story->cover);
        }

        // Hapus data dari database
        $story->delete();

        return redirect()->route('story.index')->with('success', 'Berhasil Menghapus Data');
    }

    public function detail($story_id)
    {
        // Mengambil data story berdasarkan id
        $story = Story::findOrFail($story_id);

        // Mengirim data ke view
        return view('story.detail', compact('story'));
    }

    public function show($story_id)
    {
        $story = Story::findOrFail($story_id);
        $scenes = Scene::where('story_id', $story_id)->get();
        $multipleChoices = AssesmentMultiple::where('story_id', $story_id)->get();

        return view('story.detail_story', compact('story', 'scenes', 'multipleChoices'));
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



