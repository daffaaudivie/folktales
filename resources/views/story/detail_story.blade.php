    <x-app-layout>
    <div class="max-w-8xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold mb-6">{{ $story->title }}</h2>

        <div class="mb-4">
            <img src="{{ Storage::url($story->cover) }}" alt="Cover" class="w-max max-h-400px object-cover rounded-lg mb-4">
        </div>

        <div class="mb-4">
            <span class="text-gray-600">Provinsi:</span>
            <h4 class="text-lg font-medium">{{ $story->province }}</h4>
        </div>

        <div class="mb-4">
            <span class="text-gray-600">Deskripsi:</span>
            <p class="text-gray-700 break-words">{{ $story->desc }}</p>
        </div>

        <div class="mb-4">
            <span class="text-gray-600">Status:</span>
            <h4 class="text-lg font-medium">{{ $story->status ? 'Active' : 'Inactive' }}</h4>
        </div>

        <div class="flex justify-start mb-6">
            <a href="{{ url('/create_scene') }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Tambah Scene +
                </button>
            </a>
            <a href="{{ route('story.index') }}" class="inline-flex items-center px-4 py-2 ml-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                Kembali ke Daftar Cerita
            </a>
        </div>
        
        <!-- ... existing story details ... -->

        <div class="mb-6 text-center mt-20">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">List Data Scene ( {{ $story->title  }} )</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Berikut adalah daftar scene yang telah dibuat</p>
        </div>

    <table class="mt-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-800 text-center">
        <tr>
            <th scope="col" class="px-6 py-3">Scene Order</th>
            <th scope="col" class="px-6 py-3 w-1/6">Narasi</th> 
            <th scope="col" class="px-6 py-3 w-1/4">Picture</th>  
            <th scope="col" class="px-6 py-3 w-1/4">Voice Over</th>  
            <th scope="col" class="px-6 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scenes as $scene)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 ">
            <td class="px-4 py-2 w-1/12 text-center">{{ $scene->order }}</td>
                <td class="px-4 py-3 w-1/3">{{ $scene->narasi }}</td> 
                <td class="px-6 py-4 w-1/4">
                    @if ($scene->picture)
                        <img src="{{ asset('storage/' . $scene->picture) }}" alt="Scene Image" class="h-max w-max object-cover">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td class="px-4 py-3 w-1/6">
                    @if ($scene->voice_over)
                        <audio controls>
                            <source src="{{ asset('storage/' . $scene->voice_over) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @else
                        Tidak ada voice over
                    @endif
</td>
                <td class="px-6 py-4">
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                <!-- <a href="{{ route('scene.show', $scene->scene_story_id) }}">
                                    <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Detail</button>
                                </a> -->
                                <a href="{{ route('scene.edit', $scene->scene_story_id) }}">
                                    <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                                </a>
                                <form action="{{ route('scene.destroy', $scene->scene_story_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>
</x-app-layout>
