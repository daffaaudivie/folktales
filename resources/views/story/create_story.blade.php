<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Tambah Cerita Baru</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" 
                    value="{{ old('title') }}" />
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="desc" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="desc" id="desc" rows="4" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">{{ old('desc') }}</textarea>
                @error('desc')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                <select name="province" id="province" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">
                    <option value="">Pilih Provinsi</option>
                    @foreach ($provinceList as $province)
                        <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
                @error('province')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
                <input type="file" name="cover" id="cover" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('cover')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <!-- Preview Gambar -->
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Preview Gambar:</p>
                    <img id="cover-preview" class="mt-2 w-80 h-80 object-cover rounded-md hidden" />
                </div>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full mt-4 p-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                Simpan Cerita
            </button>
        </form>
    </div>

    <!-- JavaScript untuk Preview Gambar -->
    <script>
        document.getElementById('cover').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('cover-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden'); // Menampilkan gambar preview
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden'); // Menyembunyikan preview jika tidak ada file
            }
        });
    </script>
</x-app-layout>
