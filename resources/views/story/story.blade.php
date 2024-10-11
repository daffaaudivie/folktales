<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">List Data Story</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Berikut adalah daftar story yang telah dibuat</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ url('/create_story') }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Tambah Data +
                </button>
            </a>
        </div>
        
        <table class="mt-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Province
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($m_story as $story)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $story->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $story->province }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $story->status ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('story.detail', $story->story_id) }}">
                                <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Detail
                                </button>
                            </a>
                            <a href="{{ route('story.edit', $story->story_id) }}">
                                <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                            </a>
                            <form action="{{ route('story.destroy', $story->story_id) }}" method="POST" onsubmit="return confirmDelete(event)" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form dikirim secara langsung
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form setelah konfirmasi
                    event.target.submit();
                }
            });
        }
    </script>
</x-app-layout>
