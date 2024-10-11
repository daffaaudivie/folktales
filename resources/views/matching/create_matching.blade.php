<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Tambah Data Assessment Matching</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">Silakan isi form di bawah ini</p>

        <form action="{{ route('matching.store') }}" method="POST" class="mt-6" enctype="multipart/form-data">
            @csrf

            <!-- Select Story -->
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

            <!-- Upload Picture 1 -->
            <div class="mb-4">
                <label for="picture_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Gambar 1</label>
                <input type="file" id="picture_1" name="picture_1" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" onchange="previewImage('picture_1', 'preview_1')">
                @error('picture_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <!-- Image Preview -->
                <img id="preview_1" class="mt-4 max-h-48" alt="Preview Gambar 1" style="display: none;">
            </div>

            <!-- Upload Picture 2 -->
            <div class="mb-4">
                <label for="picture_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Gambar 2</label>
                <input type="file" id="picture_2" name="picture_2" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" onchange="previewImage('picture_2', 'preview_2')">
                @error('picture_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <!-- Image Preview -->
                <img id="preview_2" class="mt-4 max-h-48" alt="Preview Gambar 2" style="display: none;">
            </div>

            <!-- Upload Picture 3 -->
            <div class="mb-4">
                <label for="picture_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Gambar 3</label>
                <input type="file" id="picture_3" name="picture_3" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" onchange="previewImage('picture_3', 'preview_3')">
                @error('picture_3')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <!-- Image Preview -->
                <img id="preview_3" class="mt-4 max-h-48" alt="Preview Gambar 3" style="display: none;">
            </div>

            <!-- Name 1 -->
            <div class="mb-4">
                <label for="name_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama 1</label>
                <input type="text" id="name_1" name="name_1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan Nama untuk Gambar 1">
                @error('name_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name 2 -->
            <div class="mb-4">
                <label for="name_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama 2</label>
                <input type="text" id="name_2" name="name_2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan Nama untuk Gambar 2">
                @error('name_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name 3 -->
            <div class="mb-4">
                <label for="name_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama 3</label>
                <input type="text" id="name_3" name="name_3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan Nama untuk Gambar 3">
                @error('name_3')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">Simpan Data</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
