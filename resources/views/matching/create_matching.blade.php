<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Add Matching Assessment Data</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">for "{{ $story->title }}"</p>

        <form id="matching" action="{{ route('matching.store') }}" method="POST" class="mt-6" enctype="multipart/form-data">
            @csrf

            <!-- Select Story -->
            <input type="hidden" name="story_id" value="{{ $story->story_id }}">

            <div class="mb-4">
                <label for="story" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <input type="text" id="story" value="{{ $story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <!-- Upload Picture 1 -->
            <div class="mb-4">
                <label for="picture_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Picture 1</label>
                <input type="file" id="picture_1" name="picture_1" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" onchange="previewImage('picture_1', 'preview_1')">
                @error('picture_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <!-- Image Preview -->
                <img id="preview_1" class="mt-4 max-h-48" alt="Preview Picture 1" style="display: none;">
            </div>

            <!-- Upload Picture 2 -->
            <div class="mb-4">
                <label for="picture_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Picture 2</label>
                <input type="file" id="picture_2" name="picture_2" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" onchange="previewImage('picture_2', 'preview_2')">
                @error('picture_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <!-- Image Preview -->
                <img id="preview_2" class="mt-4 max-h-48" alt="Preview Picture 2" style="display: none;">
            </div>

            <!-- Upload Picture 3 -->
            <div class="mb-4">
                <label for="picture_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Picture 3</label>
                <input type="file" id="picture_3" name="picture_3" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" onchange="previewImage('picture_3', 'preview_3')">
                @error('picture_3')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <!-- Image Preview -->
                <img id="preview_3" class="mt-4 max-h-48" alt="Preview Picture 3" style="display: none;">
            </div>

            <!-- Name 1 -->
            <div class="mb-4">
                <label for="name_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name 1</label>
                <input type="text" id="name_1" name="name_1" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Input Name for Picture 1">
                @error('name_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name 2 -->
            <div class="mb-4">
                <label for="name_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name 2</label>
                <input type="text" id="name_2" name="name_2" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Input Name for Picture 2">
                @error('name_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name 3 -->
            <div class="mb-4">
                <label for="name_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name 3</label>
                <input type="text" id="name_3" name="name_3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 dark:bg-gray-800 dark:text-white" placeholder="Input Name for Picture 3">
                @error('name_3')
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
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
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
                    document.getElementById('matching').submit();
                });
            }
        });
    }
</script>
</x-app-layout>
