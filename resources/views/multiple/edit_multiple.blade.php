<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Multiple Assessment</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Edit the details of the assessment that have been created.t</p>
        </div>

        <!-- Form Edit Assessment -->
        <form id="multiple" action="{{ route('multiple.update', $assessment->id_asses) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="story_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <input type="text" name="story_id" id="story_id" value="{{ $assessment->story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <!-- Question -->
            <div class="mb-6">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Question</label>
                <input id="question" name="question" rows="4" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" value="{{ $assessment->question }}" placeholder="Enter the question..."></input>
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
                        document.getElementById('multiple').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
