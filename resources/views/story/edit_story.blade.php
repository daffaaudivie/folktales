<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Story</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Edit detail story yang telah dibuat</p>
        </div>

        <!-- Form Edit Story -->
        <form id="story" action="{{ route('story.update', $story->story_id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                <input type="text" id="title" name="title" value="{{ $story->title }}" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="desc" name="desc" rows="4" class="block w-full h-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">{{ $story->desc }}</textarea>
            </div>

            <!-- Dropdown Province -->
            <div class="mb-6">
                <label for="province" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Provinsi</label>
                <select name="province" id="province" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    @foreach ($provinceList as $province)
                        <option value="{{ $province['name'] }}" {{ $story->province == $province['name'] ? 'selected' : '' }}>{{ $province['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cover -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Cover</label>
                @if ($story->cover)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $story->cover) }}" alt="Cover Image" class="w-80 h-80 object-cover rounded-lg shadow-md">
                    </div>
                @endif
                <input type="file" name="cover" id="cover" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">File types: jpeg, png, jpg, gif, svg (Max: 2MB)</p>

                <!-- Preview Gambar -->
                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Preview Gambar:</p>
                    <img id="cover-preview" class="w-80 h-80 object-cover rounded-lg shadow-md hidden">
                </div>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select name="status" id="status" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    <option value="1" {{ $story->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="2" {{ $story->status == 2 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- Tombol Simpan -->
            <div class="text-center mt-4 flex justify-center">
                <button type="button" onclick="confirmEdit()" class="flex justify-center items-center bg-green-400 hover:bg-green-500 text-dark-400 font-semibold py-2 px-4 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk Preview Gambar -->
    <script>
        // Preview image
        document.getElementById('cover').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('cover-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
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
                        document.getElementById('story').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
