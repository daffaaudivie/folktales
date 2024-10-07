<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Tambah Data Assessment Multiple Choice di Story</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">Silakan isi form di bawah ini</p>

        <form action="{{ route('multiple.storeAtStory') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pertanyaan</label>
                <input type="text" id="question" name="question" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan pertanyaan...">
                @error('question')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Field untuk opsi jawaban -->
            <div class="mb-4">
                <label for="opt_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Opsi 1</label>
                <input type="text" id="opt_1" name="opt_1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan opsi 1...">
                @error('opt_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Opsi 2</label>
                <input type="text" id="opt_2" name="opt_2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan opsi 2...">
                @error('opt_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Opsi 3</label>
                <input type="text" id="opt_3" name="opt_3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan opsi 3...">
                @error('opt_3')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_4" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Opsi 4</label>
                <input type="text" id="opt_4" name="opt_4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Masukkan opsi 4...">
                @error('opt_4')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jawaban Benar</label>
                <select id="answer" name="answer" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white">
                    <option value="opt_1">Opsi 1</option>
                    <option value="opt_2">Opsi 2</option>
                    <option value="opt_3">Opsi 3</option>
                    <option value="opt_4">Opsi 4</option>
                </select>
                @error('answer')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input hidden untuk story_id -->
            <input type="hidden" name="story_id" value="{{ $story->story_id }}">

            <div class="mt-6">
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">Simpan Data</button>
            </div>
        </form>
    </div>
</x-app-layout>
