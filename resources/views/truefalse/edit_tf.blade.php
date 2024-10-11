<x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit True/False Assessment</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Edit detail assessment yang telah dibuat</p>
        </div>

        <!-- Form Edit Assessment -->
        <form id="trueFalseForm" action="{{ route('truefalse.update', $assessment->id_asses) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Dropdown Story -->
            <div class="mb-6">
                <label for="story_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <select name="story_id" id="story_id" disabled class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    @foreach ($stories as $story)
                        <option value="{{ $story->story_id }}" {{ $assessment->story_id == $story->story_id ? 'selected' : '' }}>{{ $story->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Question -->
            <div class="mb-6">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Question</label>
                <textarea id="question" name="question" rows="4" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" placeholder="Enter the question...">{{ $assessment->question }}</textarea>
            </div>

            <!-- Answer -->
            <div class="mb-6">
                <label for="answer" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Correct Answer</label>
                <select name="answer" id="answer" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    <option value="1" {{ $assessment->answer ? 'selected' : '' }}>True</option>
                    <option value="0" {{ !$assessment->answer ? 'selected' : '' }}>False</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6 flex justify-center text-center mt-4">
                <button type="button" onclick="confirmEdit()" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                    Save Data
                </button>
            </div>
        </form>
    </div>

    <script>
        function confirmEdit() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin mengedit data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan SweetAlert untuk berhasil menyimpan data
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil diedit.',
                        icon: 'success',
                        confirmButtonText: 'Oke'
                    }).then(() => {
                        // Kirim form setelah pengguna menekan "Oke"
                        document.getElementById('trueFalseForm').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
