<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Folktales') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Story Count Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Total Stories</h3>
                    <p class="mt-2 text-4xl font-bold text-white">{{ $storyCount }}</p>
                    <p class="mt-2 text-sm text-blue-100">Total number of stories in the database.</p>
                </div>
            </div>

            <!-- Scene Story Count Card -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Total Scenes</h3>
                    <p class="mt-2 text-4xl font-bold text-white">{{ $sceneCount }}</p>
                    <p class="mt-2 text-sm text-green-100">Number of scenes related to stories.</p>
                </div>
            </div>

            <!-- Matching Assessment Count Card -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Matching Assessments</h3>
                    <p class="mt-2 text-4xl font-bold text-white">{{ $matchingCount }}</p>
                    <p class="mt-2 text-sm text-purple-100">Total matching assessments available.</p>
                </div>
            </div>

            <!-- Multiple Choice Assessment Count Card -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Multiple Choice Assessments</h3>
                    <p class="mt-2 text-4xl font-bold text-white">{{ $multipleCount }}</p>
                    <p class="mt-2 text-sm text-yellow-100">Total multiple choice assessments.</p>
                </div>
            </div>

            <!-- True/False Assessment Count Card -->
            <div class="bg-gradient-to-br from-red-500 to-red-600 overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">True/False Assessments</h3>
                    <p class="mt-2 text-4xl font-bold text-white">{{ $tfCount }}</p>
                    <p class="mt-2 text-sm text-red-100">Total true/false assessments.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout> 