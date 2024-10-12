<x-app-layout>
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 text-center">Add New Scene</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-center">for "{{ $story->title }}"</p>

        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form id="scene" action="{{ route('scene.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="story_id" value="{{ $story->story_id }}">

            <div class="mb-4">
                <label for="story" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <input type="text" id="story" value="{{ $story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <!-- Input Image untuk Scene -->
            <div class="mb-4">
                <label for="picture" class="block text-sm font-medium text-gray-700">Scene Image</label>
                <input type="file" name="picture" id="picture" required accept="image/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('picture')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <!-- Preview Image -->
                <img id="imagePreview" class="mt-4 w-full h-auto hidden" />
            </div>

            <!-- Textarea untuk narasi -->
            <div class="mb-4">
                <label for="narasi" class="block text-sm font-medium text-gray-700">Narasi</label>
                <textarea name="narasi" id="narasi" rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">{{ old('narasi') }}</textarea>
                @error('narasi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input file untuk voice over -->
            <div class="mb-4">
                <label for="voice_over" class="block text-sm font-medium text-gray-700">Voice Over</label>
                <input type="file" name="voice_over" id="voice_over" required accept="audio/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" />
                @error('voice_over')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <!-- Preview Voice Over -->
                <audio id="audioPreview" class="mt-4 w-full hidden" controls>
                    <source id="audioSource" src="" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>

            <!-- Input urutan scene -->
            <div class="mb-4">
                <label for="order" class="block text-sm font-medium text-gray-700">Scene Order</label>
                <input type="number" name="order" id="order" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" 
                    value="{{ old('order') }}" />
                @error('order')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
        document.getElementById('picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('voice_over').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const audioPreview = document.getElementById('audioPreview');
            const audioSource = document.getElementById('audioSource');
            const reader = new FileReader();

            reader.onload = function(e) {
                audioSource.src = e.target.result;
                audioPreview.load(); // Reload audio element
                audioPreview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
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
                    document.getElementById('scene').submit();
                });
            }
        });
    }
</script>
</x-app-layout>
