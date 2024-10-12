<x-app-layout>
    <div class="max-w-4xl mx-auto mt-12 p-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Matching Question</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">for "{{ $story->title }}"</p>
        </div>

        <form id="matching" action="{{ route('matching.update', $matching->id_asses) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            @for ($i = 1; $i <= 3; $i++)
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Picture & Name {{ $i }}</h3>
                    <div class="md:flex md:space-x-6">
                        <div class="md:w-1/2 mb-4 md:mb-0">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Picture</label>
                                <img src="{{ asset('storage/' . $matching->{"picture_$i"}) }}" alt="Current Picture {{ $i }}" class="h-40 w-40 object-cover rounded-md shadow-md mx-auto">
                            </div>
                            
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Picture</label>
                                <input type="file" name="picture_{{ $i }}" id="picture_{{ $i }}" class="hidden" onchange="previewImage(event, {{ $i }})">
                                
                                <label for="picture_{{ $i }}" class="cursor-pointer bg-blue-50 text-dark-700 hover:bg-blue-100 font-semibold py-2 px-4 rounded-full text-sm inline-block">
                                    Choose New Image
                                </label>
                                
                                <span id="file-name-{{ $i }}" class="ml-4 text-sm text-gray-600 dark:text-gray-400"></span>
                            </div>

                            <div class="mt-4">
                                <img id="preview{{ $i }}" alt="New Picture {{ $i }}" class="h-40 w-40 object-cover rounded-md shadow-md mx-auto hidden">
                            </div>
                        </div>
                        <div class="md:w-1/2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" name="name_{{ $i }}" value="{{ $matching->{"name_$i"} }}" class="w-full p-2.5 border rounded-lg bg-white dark:bg-gray-600 text-gray-700 dark:text-gray-300">
                        </div>
                    </div>
                </div>
            @endfor

            <div class="text-center mt-8">
                <button type="button" onclick="confirmEdit()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event, index) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview' + index);
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);

                // Display the file name next to the "Choose New Image" button
                const fileNameLabel = document.getElementById('file-name-' + index);
                fileNameLabel.textContent = file.name;
            }
        }
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
                        document.getElementById('matching').submit();
                    });
                }
            });
        }
    </script>
</x-app-layout>
