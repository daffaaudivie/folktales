<!-- <x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">List Data Scene</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Berikut adalah daftar scene yang telah dibuat</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ url('/create_scene') }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Tambah Data +
                </button>
            </a>
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
                @foreach ($t_scene_story as $scene)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
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
                        <td class="px-4 py-3 w-1/6">
                            <a href="{{ route('scene.edit', $scene->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('scene.destroy', $scene->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout> -->
