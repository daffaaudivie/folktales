<x-app-layout>
    <div class="max-w-8xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Edit Matching Question for {{ $story->title }}</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Edit each picture and name pair.</p>
        </div>

        <form action="{{ route('matching.update', $matching->id_asses) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Picture 1 & Name 1 -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Picture 1</label>
                <div class="flex items-center justify-between">
                    <img src="{{ asset('storage/' . $matching->picture_1) }}" alt="Picture 1" class="h-40 w-40 object-cover rounded-md shadow-md">
                    <input type="file" name="picture_1" class="ml-4">
                </div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">Name 1</label>
                <input type="text" name="name_1" value="{{ $matching->name_1 }}" class="w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            </div>

            <!-- Picture 2 & Name 2 -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Picture 2</label>
                <div class="flex items-center justify-between">
                    <img src="{{ asset('storage/' . $matching->picture_2) }}" alt="Picture 2" class="h-40 w-40 object-cover rounded-md shadow-md">
                    <input type="file" name="picture_2" class="ml-4">
                </div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">Name 2</label>
                <input type="text" name="name_2" value="{{ $matching->name_2 }}" class="w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            </div>

            <!-- Picture 3 & Name 3 -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Picture 3</label>
                <div class="flex items-center justify-between">
                    <img src="{{ asset('storage/' . $matching->picture_3) }}" alt="Picture 3" class="h-40 w-40 object-cover rounded-md shadow-md">
                    <input type="file" name="picture_3" class="ml-4">
                </div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">Name 3</label>
                <input type="text" name="name_3" value="{{ $matching->name_3 }}" class="w-full p-2.5 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
