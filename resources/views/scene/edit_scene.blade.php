<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Scene</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">for "{{ $scene->story->title }}"</p>
        </div>

        <!-- Form Edit Scene -->
        <form id="scene" action="{{ route('scene.update', $scene->scene_story_id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="story_title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Judul Story</label>
                <input type="text" name="story_title" id="story_title" value="{{ $scene->story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <!-- Narasi -->
            <div class="mb-6">
                <label for="narasi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Narasi</label>
                <textarea id="narasi" name="narasi" rows="4" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600" placeholder="Masukkan narasi...">{{ $scene->narasi }}</textarea>
            </div>

            <!-- Picture -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                @if ($scene->picture)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $scene->picture) }}" alt="Scene Image" class="w-150 h-80 object-cover rounded-lg shadow-md">
                    </div>
                @endif
                <input type="file" name="picture" id="picture" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">File types: jpeg, png, jpg, gif, svg</p>

                <!-- Image Preview -->
                <div class="mt-4 w-full">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Preview Gambar:</p>
                    <img id="image-preview" class="w-80 h-80 object-cover rounded-lg shadow-md hidden">
                </div>
            </div>

            <!-- Voice Over -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Voice Over</label>
                @if ($scene->voice_over)
                    <audio controls class="mb-4 w-full">
                        <source src="{{ asset('storage/' . $scene->voice_over) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @endif
                <input type="file" name="voice_over" id="voice_over" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">File types: mp3, wav, aac (Max: 10MB)</p>

                <!-- Audio Preview -->
                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Preview Voice Over:</p>
                    <audio id="audio-preview" controls class="w-full hidden">
                        <source id="audio-source" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>

            <!-- Order -->
            <div class="mb-6">
                <label for="order" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Scene Order</label>
                <input type="number" id="order" name="order" value="{{ $scene->order }}" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
            </div>

            <!-- Tombol Submit -->
            <div class="text-center mt-8">
                <button type="button" onclick="confirmEdit()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk Preview Gambar dan Audio -->
    <script>
        // Preview image
        document.getElementById('picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });

        // Preview audio
        document.getElementById('voice_over').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('audio-preview');
            const audioSource = document.getElementById('audio-source');
            if (file) {
                const audioURL = URL.createObjectURL(file);
                audioSource.src = audioURL;
                preview.classList.remove('hidden');
                preview.load();
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
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
                        document.getElementById('scene').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>