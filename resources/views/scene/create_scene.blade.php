<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Tambah Scene Baru</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form id="scene" action="{{ route('scene.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Dropdown untuk memilih story -->
            <div class="mb-4">
                <label for="story_id" class="block text-sm font-medium text-gray-700">Cerita</label>
                <select name="story_id" id="story_id" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">
                    <option value="">Pilih Cerita</option>

                    @foreach ($m_story as $story)  <!-- Ubah dari $t_scene_story ke $m_story -->
                        <option value="{{ $story->story_id }}">{{ $story->title }}</option>
                    @endforeach

                </select>
                @error('story_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input gambar untuk Scene -->
            <div class="mb-4">
                <label for="picture" class="block text-sm font-medium text-gray-700">Gambar Scene</label>
                <input type="file" name="picture" id="picture" required accept="image/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('picture')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <!-- Preview Gambar -->
                <img id="imagePreview" class="mt-4 w-full h-auto hidden" />
            </div>

            <!-- Textarea untuk narasi -->
            <div class="mb-4">
                <label for="narasi" class="block text-sm font-medium text-gray-700">Narasi</label>
                <textarea name="narasi" id="narasi" rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">{{ old('narasi') }}</textarea>
                @error('narasi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input file untuk voice over -->
            <div class="mb-4">
                <label for="voice_over" class="block text-sm font-medium text-gray-700">Voice Over</label>
                <input type="file" name="voice_over" id="voice_over" required accept="audio/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('voice_over')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <!-- Preview Voice Over -->
                <audio id="audioPreview" class="mt-4 w-full hidden" controls>
                    <source id="audioSource" src="" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>

            <!-- Input urutan scene -->
            <div class="mb-4">
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan Scene</label>
                <input type="number" name="order" id="order" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" 
                    value="{{ old('order') }}" />
                @error('order')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
        document.getElementById('picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('voice_over').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const audioPreview = document.getElementById('audioPreview');
            const audioSource = document.getElementById('audioSource');
            const reader = new FileReader();

            reader.onload = function(e) {
                audioSource.src = e.target.result;
                audioPreview.load(); // Reload audio element
                audioPreview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
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
                        document.getElementById('scene').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
