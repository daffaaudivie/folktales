<?php

namespace App\Http\Controllers;

use App\Models\TrueFalse;
use App\Models\Story;
use App\Models\Scene;
use App\Models\AssesmentMultiple;
use Illuminate\Http\Request;

class TrueFalseController extends Controller
{
    public function index()
    {
        // Ambil semua data dari t_assesment_tf dengan relasi ke story
        $t_assesment_tf = TrueFalse::with('story')->get();

        return view('truefalse.tf', compact('t_assesment_tf'));
    }

    // Menampilkan form pembuatan assessment
    public function create()
    {
        // Ambil semua data dari m_story untuk dropdown
        $stories = Story::all();

        // Ambil semua assessment untuk ditampilkan
        $assessments = TrueFalse::with('story')->get();

        return view('truefalse.create_tf', compact('stories', 'assessments'));
    }

    // Menyimpan data assessment baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'story_id' => 'required|exists:m_story,story_id',
            'question' => 'required|string|max:255',
            'answer'   => 'required|boolean',
        ]);

        // Simpan data assessment baru
        TrueFalse::create($request->all());

        // Redirect ke halaman detail story dengan flash message untuk alert
        return redirect()->route('story.detail', ['story_id' => $request->story_id])
                        ->withFragment('truefalse') // Mengarahkan ke section
                        ->with('success', 'Assessment created successfully.');
    }



    // Menampilkan form edit assessment
    public function edit(string $id_asses)
    {
        $assessment = TrueFalse::findOrFail($id_asses);
        $stories = Story::all();

        return view('truefalse.edit_tf', compact('assessment', 'stories'));
    }

    // Mengupdate data assessment
    public function update(Request $request, string $id_asses)
{
    // Validasi input
    $request->validate([
        'story_id' => 'nullable|exists:m_story,story_id',
        'question' => 'required|string|max:255',
        'answer' => 'required|boolean',
    ]);

    // Cari assessment berdasarkan ID
    $assessment = TrueFalse::findOrFail($id_asses);

    // Simpan story_id sebelum mengupdate
    $storyId = $assessment->story_id;

    // Update data assessment
    $assessment->update($request->all());

    // Redirect ke halaman detail story setelah berhasil update
    return redirect()->route('story.detail', ['story_id' => $storyId])
                     ->with('success', 'Assessment edited successfully.')
                     ->withFragment('truefalse');
}


    


    // Menghapus data assessment
    public function destroy(string $id_asses)
    {
        // Cari assessment berdasarkan ID
        $assessment = TrueFalse::findOrFail($id_asses);

        // Simpan story_id sebelum menghapus
        $storyId = $assessment->story_id;

        // Hapus data assessment
        $assessment->delete();

        // Redirect ke detail story
        return redirect()->route('story.detail', ['story_id' => $storyId])
                        ->with('success', 'Assessment deleted successfully.')
                        ->withFragment('truefalse');
    }


    // Menampilkan detail data berdasarkan story_id
    public function detail($story_id)
    {
        // Ambil story berdasarkan ID
        $story = Story::findOrFail($story_id);

        // Ambil semua assessment yang terkait dengan story ini
        $t_assesment_tf = TrueFalse::where('story_id', $story_id)->get();

        // Kembalikan view dengan variabel story dan t_assesment_tf
        return view('story.detail_story', compact('story', 't_assesment_tf'));
    }


    public function create_at_story($story_id)
    {

        $story = Story::findOrFail($story_id);

        // Ambil semua assessment yang terkait dengan story ini
        $assessments = TrueFalse::where('story_id', $story_id)->get();

        // Ambil semua stories untuk dropdown
        $stories = Story::all();

        // Kembalikan view create dengan data story, assessment, dan stories yang terkait
        return view('truefalse.create_at_story', compact('story', 'assessments', 'stories'));
    }

    // Menyimpan data assessment baru di dalam story
    public function storeAtStory(Request $request)
    {
        // Validasi input
        $request->validate([
            'story_id' => 'required|exists:m_story,story_id',
            'question' => 'required|string|max:255',
            'answer'   => 'required|boolean',
        ]);

        // Simpan data assessment baru
        TrueFalse::create($request->all());

        return redirect()->route('truefalse.create_at_story', ['story_id' => $request->story_id])
                         ->with('success','Assessment created successfully.');
    }

    public function showAssessmentDetail($story_id)
{
    // Ambil story berdasarkan ID
    $story = Story::findOrFail($story_id);

    // Ambil semua assessment yang terkait dengan story ini
    $assessments = TrueFalse::where('story_id', $story_id)->get();

    return view('story.detail_story', compact('story', 'assessments', 'scenes', 'multipleChoices'));
}
}
