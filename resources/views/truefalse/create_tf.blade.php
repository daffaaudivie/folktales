<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Tambah Data Assessment True/False</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">Silakan isi form di bawah ini</p>

        <form id="trueFalseForm" action="{{ route('truefalse.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="story_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Story</label>
                <select id="story_id" name="story_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white">
                    <option value="">Pilih Story</option>
                    @foreach ($stories as $story)
                        <option value="{{ $story->story_id }}">{{ $story->title }}</option>
                    @endforeach
                </select>
                @error('story_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pertanyaan</label>
                <input type="text" id="question" name="question" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan pertanyaan...">
                @error('question')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jawaban</span>
                <div class="mt-2 space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="answer" value="1" class="form-radio h-4 w-4 text-green-500" {{ old('answer') == '1' ? 'checked' : '' }}>
                        <span class="ml-2">True</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="answer" value="0" class="form-radio h-4 w-4 text-green-500" {{ old('answer') == '0' ? 'checked' : '' }}>
                        <span class="ml-2">False</span>
                    </label>
                </div>
                @error('answer')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <!-- Change button type to button to avoid automatic form submission -->
                <button type="button" onclick="confirmCreate()" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

    <script>
        function confirmCreate() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menyimpan data ini?",
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
                        text: 'Data berhasil disimpan.', 
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
