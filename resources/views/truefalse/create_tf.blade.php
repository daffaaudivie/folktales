<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Add True/False Question</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">for "{{ $story->title }}"</p>

        <form id="trueFalseForm" action="{{ route('truefalse.store') }}" method="POST" class="mt-6">
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
                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Answer</span>
                <div class="mt-2 space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="answer" value="1" class="form-radio h-4 w-4 text-green-500" {{ old('answer') == '1' ? 'checked' : '' }}>
                        <span class="ml-2">True</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="answer" value="0" class="form-radio h-4 w-4 text-green-500" {{ old('answer') == '0' ? 'checked' : '' }}>
                        <span class="ml-2">False</span>
                    </label>
                </div>
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
            text: "Are you sure you want to add this data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Add this data!',
            customClass: {
                confirmButton: 'swal2-confirm swal2-styled',
                cancelButton: 'swal2-cancel swal2-styled'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show success alert
                Swal.fire({
                    title: 'Success!',
                    text: 'Data has been saved.',
                    icon: 'success',
                    confirmButtonText: 'Okay',
                    customClass: {
                        confirmButton: 'swal2-confirm swal2-styled'
                    }
                }).then(() => {
                    // Submit the form after the user presses "Okay"
                    document.getElementById('trueFalseForm').submit();
                });
            }
        });
    }
</script>

</x-app-layout>