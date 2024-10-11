<?php

namespace App\Http\Controllers;

use App\Models\AssesmentMultiple;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultipleController extends Controller
{
    // Menampilkan semua data dari t_assesment_multiple beserta relasinya
    public function index()
    {
        // Ambil semua data dari t_assesment_multiple
        $t_assesment_multiple = AssesmentMultiple::with('story')->get();

        return view('multiple.multiple', compact('t_assesment_multiple'));
    }

    public function showAssessmentDetail($story_id)
    {
        // Ambil story berdasarkan ID
        $story = Story::findOrFail($story_id);

        // Ambil semua assessment yang terkait dengan story ini
        $assessments = AssesmentMultiple::where('story_id', $story_id)->get();

        return view('story.detail_story', compact('story', 'assessments', 'scenes', 'multipleChoices'));
    }

    // Menampilkan form pembuatan assessment
    public function create()
    {
        // Ambil semua data dari m_story untuk dropdown
        $stories = Story::all();

        // Ambil semua assessment untuk ditampilkan
        $assessments = AssesmentMultiple::with('story')->get(); 

        return view('multiple.create_multiple', compact('stories', 'assessments')); 
    }

    // Menyimpan data assessment baru
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'story_id' => 'required|exists:m_story,story_id', // Pastikan sesuai dengan nama tabel di database
            'question' => 'required|string|max:255',
            'opt_1' => 'required|string|max:255',
            'opt_2' => 'required|string|max:255',
            'opt_3' => 'required|string|max:255',
            'opt_4' => 'required|string|max:255',
            'answer' => 'required|string|max:255|in:opt_1,opt_2,opt_3,opt_4',
        ]);

        // Simpan data assessment baru
        AssesmentMultiple::create($request->all());

        return redirect()->route('story.detail', ['story_id' => $request->story_id])
                     ->withFragment('multiple') // Mengarahkan ke section
                     ->with('success', 'Assessment created successfully.');
    }

    // Menampilkan form edit assessment
    public function edit(string $id_asses)
    {
        $assessment = AssesmentMultiple::findOrFail($id_asses);
        $stories = Story::all();

        return view('multiple.edit_multiple', compact('assessment', 'stories'));
    }

    // Mengupdate data assessment
    public function update(Request $request, string $id_asses)
    {
        // Validasi input
        $request->validate([
            'story_id' => 'nullable|exists:m_story,story_id',
            'question' => 'required|string|max:255',
            'opt_1' => 'required|string|max:255',
            'opt_2' => 'required|string|max:255',
            'opt_3' => 'required|string|max:255',
            'opt_4' => 'required|string|max:255',
            'answer' => 'required|string|in:opt_1,opt_2,opt_3,opt_4',
        ]);

        // Cari assessment berdasarkan ID
        $assessment = AssesmentMultiple::findOrFail($id_asses);

        // Update data assessment
        $storyId = $assessment->story_id;

        // Update data assessment
        $assessment->update($request->all());
    
        // Redirect ke halaman detail story setelah berhasil update
        return redirect()->route('story.detail', ['story_id' => $storyId])
                         ->with('success', 'Assessment edited successfully.')
                         ->withFragment('multiple');
    }

    // Menghapus data assessment
    public function destroy(string $id_asses)
    {
        // Cari assessment berdasarkan ID
        $assessment = AssesmentMultiple::findOrFail($id_asses);

        $storyId = $assessment->story_id;

        // Hapus data assessment
        $assessment->delete();

        return redirect()->route('story.detail', ['story_id' => $storyId])
                        ->with('success', 'Assessment deleted successfully.')
                        ->withFragment('multiple');
    }

    // Menampilkan detail data berdasarkan story_id
    public function detail($story_id)
    {
        // Ambil story berdasarkan ID
        $story = Story::findOrFail($story_id);

        // Ambil semua assessment yang terkait dengan story ini
        $t_assesment_multiple = AssesmentMultiple::where('story_id', $story_id)->get();

        // Kembalikan view dengan variabel story dan t_assesment_multiple
        return view('story.detail_story', compact('story', 't_assesment_multiple'));
    }

    public function create_multiple_at_story($story_id)
{
    // Ambil story berdasarkan ID untuk konfirmasi
    $story = Story::findOrFail($story_id);

    // Ambil semua assessment yang terkait dengan story ini
    $assessments = AssesmentMultiple::where('story_id', $story_id)->get();

    // Ambil semua stories untuk dropdown
    $stories = Story::all();

    // Kembalikan view create dengan data story, assessment, dan stories yang terkait
    return view('multiple.create_multiple_at_story', compact('story', 'assessments', 'stories'));
}

public function storeAtStory(Request $request)
{
    // Validasi input
    $request->validate([
        'story_id' => 'required|exists:m_story,story_id',
        'question' => 'required|string|max:255',
        'opt_1' => 'required|string|max:255',
        'opt_2' => 'required|string|max:255',
        'opt_3' => 'required|string|max:255',
        'opt_4' => 'required|string|max:255',
        'answer' => 'required|string|in:opt_1,opt_2,opt_3,opt_4',
    ]);

    // Simpan data assessment baru
    AssesmentMultiple::create($request->all());

    return redirect()->route('multiple.create_multiple_at_story', ['story_id' => $request->story_id])
                     ->with('success', 'Assessment created successfully.');
}

}
