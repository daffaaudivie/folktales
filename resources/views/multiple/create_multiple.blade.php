<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Add Multiple Choice Question</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">for "{{ $story->title }}"</p>

        <!-- Form for multiple choice question -->
        <form id="multipleChoiceForm" action="{{ route('multiple.store') }}" method="POST" class="mt-6">
            @csrf

            <!-- Hidden input for story_id -->
            <input type="hidden" name="story_id" value="{{ $story->story_id }}">

            <div class="mb-4">
                <label for="story" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <input type="text" id="story" value="{{ $story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Question</label>
                <input type="text" id="question" name="question" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Enter the question...">
                @error('question')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option 1</label>
                <input type="text" id="opt_1" name="opt_1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Enter option 1...">
                @error('opt_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option 2</label>
                <input type="text" id="opt_2" name="opt_2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Enter option 2...">
                @error('opt_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option 3</label>
                <input type="text" id="opt_3" name="opt_3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Enter option 3...">
                @error('opt_3')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="opt_4" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Option 4</label>
                <input type="text" id="opt_4" name="opt_4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Enter option 4...">
                @error('opt_4')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correct Answer</label>
                <select id="answer" name="answer" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white">
                    <option value="opt_1">Option 1</option>
                    <option value="opt_2">Option 2</option>
                    <option value="opt_3">Option 3</option>
                    <option value="opt_4">Option 4</option>
                </select>
                @error('answer')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center mt-8">
                <button type="button" onclick="confirmCreate()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Data
                </button>
            </div>
        </form>
    </div>

    <script>
        function confirmCreate() {
            Swal.fire({
                title: 'Confirmation',
                text: "Are you sure you want to save this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Add this data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show SweetAlert for successful data saving
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved.',
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    }).then(() => {
                        // Submit the form after the user presses "Okay"
                        document.getElementById('multipleChoiceForm').submit();
                    });
                }
            });
        }
    </script>

</x-app-layout>
