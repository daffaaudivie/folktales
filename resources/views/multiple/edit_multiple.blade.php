<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Multiple Assessment</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Edit detail assessment yang telah dibuat</p>
        </div>

        <!-- Form Edit Assessment -->
        <form action="{{ route('multiple.update', $assessment->id_asses) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Dropdown Story -->
            <div class="mb-6">
                <label for="story_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <select name="story_id" id="story_id" disabled class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    @foreach ($stories as $story)
                        <option value="{{ $story->story_id }}" {{ $assessment->story_id == $story->story_id ? 'selected' : '' }}>{{ $story->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Question -->
            <div class="mb-6">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Question</label>
                <textarea id="question" name="question" rows="4" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" placeholder="Enter the question...">{{ $assessment->question }}</textarea>
            </div>

            <!-- Options -->
            @for ($i = 1; $i <= 4; $i++)
                <div class="mb-6">
                    <label for="opt_{{ $i }}" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Option {{ $i }}</label>
                    <input type="text" id="opt_{{ $i }}" name="opt_{{ $i }}" value="{{ $assessment['opt_'.$i] }}" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" placeholder="Enter option {{ $i }}">
                </div>
            @endfor

            <!-- Answer -->
            <div class="mb-6">
                <label for="answer" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Correct Answer</label>
                <select name="answer" id="answer" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    @for ($i = 1; $i <= 4; $i++)
                        <option value="opt_{{ $i }}" {{ $assessment->answer == 'opt_'.$i ? 'selected' : '' }}>Option {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-center text-center mt-4">
                <button type="submit" class="flex justify-center items-center bg-green-400 hover:bg-green-500 text-dark-400 font-semibold py-2 px-4 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
