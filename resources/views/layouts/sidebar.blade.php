<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-700 text-white p-4 min-h-screen fixed top-20"> <!-- Tambahkan 'top-20' -->
        <ul class="space-y-2">
            <li>
                <a href="{{ url('/dashboard') }}" class="mt-3 block py-2 px-4 hover:bg-gray-900 rounded">Dashboard</a>
            </li>

            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 hover:bg-gray-900 rounded">
                    <span>Story</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul x-show="open" class="pl-4 mt-2 space-y-2">
                    <li><a href="{{ url('/story') }}" class="block py-2 px-4 hover:bg-gray-900 rounded">List Data Story</a></li>
                    <li><a href="{{ url('/create_story') }}" class="block py-2 px-4 hover:bg-gray-900 rounded">Create New Story</a></li>
                </ul>
            </li>

            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 hover:bg-gray-900 rounded">
                    <span>Scene</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul x-show="open" class="pl-4 mt-2 space-y-2">
                    <li><a href="{{ url('/scene') }}" class="block py-2 px-4 hover:bg-gray-900 rounded">List Data Scene</a></li>
                    <li><a href="{{ url('/create_scene') }}" class="block py-2 px-4 hover:bg-gray-900 rounded">Create New Scene</a></li>
                </ul>
            </li>

            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 hover:bg-gray-900 rounded">
                    <span>Assessment</span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul x-show="open" class="pl-4 mt-2 space-y-2">
                    <li><a href="{{ url('/landingpage') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Assessment Multiple</a></li>
                    <li><a href="{{ url('/landingpage') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Assessment True/False</a></li>
                    <li><a href="{{ url('/landingpage') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Assessment Matching</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Konten utama -->
    <div class="flex-1 p-4 ml-64 mt-20"> <!-- Tambahkan 'mt-20' agar konten utama berada di bawah navigation bar -->
        <!-- Konten utama Anda di sini -->
    </div>
</div>
