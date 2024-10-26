<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <!-- Judul Halaman -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Story Data</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">for "{{ $story->title }}"</p>
        </div>

        <!-- Form Edit Story -->
        <form id="story" action="{{ route('story.update', $story->story_id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <input type="hidden" name="title" value="{{ $story->title }}">
            <div class="mb-6">
                <label for="story_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Story</label>
                <input type="text" name="story_id" id="story_id" value="{{ $story->title }}" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300" readonly>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="desc" name="desc" rows="4" class="block w-full h-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">{{ $story->desc }}</textarea>
            </div>

            <!-- Dropdown Province -->
            <div class="mb-6">
                <label for="province" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Provinsi</label>
                <select name="province" id="province" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    @foreach ($provinceList as $province)
                        <option value="{{ $province['name'] }}" {{ $story->province == $province['name'] ? 'selected' : '' }}>{{ $province['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cover -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Cover</label>
                @if ($story->cover)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $story->cover) }}" alt="Cover Image" class="w-80 h-80 object-cover rounded-lg shadow-md">
                    </div>
                @endif
                <input type="file" name="cover" id="cover" class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">File types: jpeg, png, jpg, gif, svg (Max: 2MB)</p>

                <!-- Preview Gambar -->
                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Image Preview   :</p>
                    <img id="cover-preview" class="w-80 h-80 object-cover rounded-lg shadow-md hidden">
                </div>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select name="status" id="status" class="block w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600">
                    <option value="1" {{ $story->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ $story->status == 2 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Tombol Simpan -->
            <div class="text-center mt-8">
                <button type="button" onclick="confirmEdit()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk Preview Gambar -->
    <script>
        // Preview image
        document.getElementById('cover').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('cover-preview');
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
                        document.getElementById('story').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
