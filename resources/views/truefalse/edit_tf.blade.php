<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Page Title -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit True/False Assessment</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">for "{{ $assessment->story->title }}"</p>
        </div>

        <!-- Edit Assessment Form -->
        <form id="trueFalseForm" action="{{ route('truefalse.update', $assessment->id_asses) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Story Input -->
            <div class="mb-6">
                <label for="story_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <input type="text" name="story_id" id="story_id" value="{{ $assessment->story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <!-- Question Input -->
            <div class="mb-6">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Question</label>
                <input type="text" id="question" name="question" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" placeholder="Enter the question..." value="{{ $assessment->question }}" required />
            </div>

            <!-- Answer Input -->
            <div class="mb-6">
                <label for="answer" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Correct Answer</label>
                <select name="answer" id="answer" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    <option value="1" {{ $assessment->answer ? 'selected' : '' }}>True</option>
                    <option value="0" {{ !$assessment->answer ? 'selected' : '' }}>False</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-8">
                <button type="button" onclick="confirmEdit()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        function confirmEdit() {
            Swal.fire({
                title: 'Confirmation',
                text: "Are you sure you want to edit this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show SweetAlert for successful data saving
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been edited successfully.',
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    }).then(() => {
                        // Submit the form after the user presses "Okay"
                        document.getElementById('trueFalseForm').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
