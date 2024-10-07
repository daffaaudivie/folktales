<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">List Data Assessment Multiple Choice</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Berikut adalah daftar assessment yang telah dibuat</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('multiple.create') }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Tambah Data +
                </button>
            </a>
        </div>

        <table class="mt-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Pertanyaan</th>
                    <th scope="col" class="px-6 py-3">Opsi 1</th>
                    <th scope="col" class="px-6 py-3">Opsi 2</th>
                    <th scope="col" class="px-6 py-3">Opsi 3</th>
                    <th scope="col" class="px-6 py-3">Opsi 4</th>
                    <th scope="col" class="px-6 py-3">Jawaban</th>
                    <th scope="col" class="px-6 py-3">Story</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($t_assesment_multiple as $index => $assessment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->question }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->opt_1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->opt_2 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->opt_3 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->opt_4 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->answer }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $assessment->story->title ?? 'Tidak Ada' }} {{-- Pastikan ada relasi 'story' di model AssesmentMultiple --}}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('multiple.edit', $assessment->id_asses) }}">
                                <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                            </a>
                            <form action="{{ route('multiple.destroy', $assessment->id_asses) }}" method="POST" class="inline">
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
</x-app-layout>
