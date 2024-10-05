<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Tambah Scene Baru</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('scene.store') }}" method="POST" enctype="multipart/form-data">
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
                <input type="file" name="picture" id="picture" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('picture')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                <input type="file" name="voice_over" id="voice_over" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('voice_over')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
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

            <button type="submit" class="w-full mt-4 p-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                Simpan Scene
            </button>
        </form>
    </div>
</x-app-layout>
