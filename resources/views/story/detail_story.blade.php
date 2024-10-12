    <x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <div class="max-w-8xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-3xl font-semibold mb-6">{{ $story->title }}</h2>

            <div class="mb-4">
                <img src="{{ Storage::url($story->cover) }}" alt="Cover" class="w-max h-80 object-cover rounded-lg mb-4">
            </div>

            <div class="mb-4">
                <span class="text-gray-600">Provinsi:</span>
                <h4 class="text-lg font-medium">{{ $story->province }}</h4>
            </div>

            <div class="mb-4">
                <span class="text-gray-600">Deskripsi:</span>
                <p class="text-gray-700 break-words">{{ $story->desc }}</p>
            </div>

            <div class="mb-4">
                <span class="text-gray-600">Status:</span>
                <h4 class="text-lg font-medium">{{ $story->status ? 'Active' : 'Inactive' }}</h4>
            </div>

            <div class="flex justify-start mt-10 mr-10">
                <a href="{{ route('story.index') }}" class="inline-flex items-center px-4 py-2 ml-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                    Kembali ke Daftar Cerita
                </a>
            </div>
        </div>

        <!-- Tabel List Scene -->
         <section id="scene">
        <div class="max-w-8xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">List Data Scene ( {{ $story->title }} )</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Here is the list of scenes that have been created.</p>
            </div>
            <a class="flex justify-end" href="{{ route('scene.create', ['story_id' => $story->story_id]) }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Add New Scene  +
                </button>
            </a>

            <table class="mt-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-800 text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3">Scene Order</th>
                        <th scope="col" class="px-6 py-3 w-1/6">Narasi</th>
                        <th scope="col" class="px-6 py-3 w-1/4">Picture</th>
                        <th scope="col" class="px-6 py-3 w-1/4">Voice Over</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scenes as $scene)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-4 py-2 w-1/12 text-center">{{ $scene->order }}</td>
                            <td class="px-4 py-3 w-1/3">{{ $scene->narasi }}</td>
                            <td class="px-6 py-4 w-1/4">
                                @if ($scene->picture)
                                    <img src="{{ asset('storage/' . $scene->picture) }}" alt="Scene Image" class="h-max w-max object-cover">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td class="px-4 py-3 w-1/6">
                                @if ($scene->voice_over)
                                    <audio controls>
                                        <source src="{{ asset('storage/' . $scene->voice_over) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                @else
                                    Tidak ada voice over
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                    <a href="{{ route('scene.edit', $scene->scene_story_id) }}">
                                        <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                                    </a>
                                    <form onsubmit="return confirmDelete(event, 'scene')" action="{{ route('scene.destroy', $scene->scene_story_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                                     </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </section>

        <!-- Tabel Multiple Choice -->
        <section id="multiple">
        <div class="max-w-8xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Multiple Choice Question ({{ $story->title }})</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Here is the list of multiple choice questions related to this story.</p>
            </div>

            <a class="flex justify-end" href="{{ route('multiple.create', ['story_id' => $story->story_id]) }}">
            <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                Add Question +
            </button>
        </a>
            <table class="mt-3 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-center text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">No</th>
                        <th scope="col" class="px-6 py-3">Question</th>
                        <th scope="col" class="px-6 py-3">Answer</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($multipleChoices as $index => $multiple)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $multiple->question }}</td>
                            <td class="px-6 py-4">{{ $multiple->{$multiple->answer} }}</td>
                            <td class="px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                        <!-- Tombol Detail -->
                        <button type="button" onclick="openModal('{{ $multiple->id }}', '{{ $multiple->question }}', '{{ $multiple->opt_1 }}', '{{ $multiple->opt_2 }}', '{{ $multiple->opt_3 }}', '{{ $multiple->opt_4 }}', '{{ $multiple->answer }}')" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Detail
                        </button>
                        <!-- Tombol Edit -->
                        <a href="{{ route('multiple.edit', $multiple->id_asses) }}">
                            <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                        </a>
                        <!-- Tombol Delete -->
                        <form onsubmit="return confirmDelete(event)" action="{{ route('multiple.destroy', $multiple->id_asses) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                        </form>
                    </div>
                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada pertanyaan multiple choice yang terkait dengan cerita ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </section>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden flex items-center justify-center z-50">
            <div class="bg-white w-3/4 md:w-1/2 lg:w-1/3 p-6 rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Detail Multiple Choice</h2>
                <p id="modal-question" class="mb-2"><strong>Question:</strong> </p>
                <p id="modal-opt_1" class="mb-2"><strong>Option 1:</strong> </p>
                <p id="modal-opt_2" class="mb-2"><strong>Option 2:</strong> </p>
                <p id="modal-opt_3" class="mb-2"><strong>Option 3:</strong> </p>
                <p id="modal-opt_4" class="mb-2"><strong>Option 4:</strong> </p>
                <p id="modal-answer" class="mb-2"><strong>Correct Answer:</strong> </p>
                <div class="flex justify-end">
                    <button id="modal-close" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-lg">Close</button>
                </div>
            </div>
        </div>

        <script>
            function openModal(id, question, opt1, opt2, opt3, opt4, answer) {
                document.getElementById('modal').classList.remove('hidden');
                document.getElementById('modal-question').innerHTML = `<strong>Question:</strong> ${question}`;
                document.getElementById('modal-opt_1').innerHTML = `<strong>Option 1:</strong> ${opt1}`;
                document.getElementById('modal-opt_2').innerHTML = `<strong>Option 2:</strong> ${opt2}`;
                document.getElementById('modal-opt_3').innerHTML = `<strong>Option 3:</strong> ${opt3}`;
                document.getElementById('modal-opt_4').innerHTML = `<strong>Option 4:</strong> ${opt4}`;
                document.getElementById('modal-answer').innerHTML = `<strong>Correct Answer:</strong> ${getAnswerText(answer, opt1, opt2, opt3, opt4)}`;
            }

            function getAnswerText(answer, opt1, opt2, opt3, opt4) {
                switch(answer) {
                    case 'opt_1': return opt1;
                    case 'opt_2': return opt2;
                    case 'opt_3': return opt3;
                    case 'opt_4': return opt4;
                    default: return 'Not specified';
                }
            }

            document.getElementById('modal-close').addEventListener('click', function () {
                document.getElementById('modal').classList.add('hidden');
            });
        </script>

        <!-- Tabel True False -->
        <section id="truefalse">
        <div class="max-w-8xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">True False Questions ({{ $story->title }})</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Here is the list of True/False questions related to this story.</p>
            </div>

            <a class="flex justify-end" href="{{ route('truefalse.create', ['story_id' => $story->story_id]) }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Add True False +
                </button>
            </a>

                <table class="mt-3 w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-center text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Question</th>
                        <th scope="col" class="px-6 py-3">Answer</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($trueFalseQuestions as $index => $trueFalse)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $trueFalse->question }}</td>
                        <td class="px-6 py-4">{{ $trueFalse->answer ? 'True' : 'False' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="{{ route('truefalse.edit', $trueFalse->id_asses) }}">
                                    <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                                </a>
                                <!-- Tombol Delete -->
                                <form onsubmit="return confirmDelete(event)" action="{{ route('truefalse.destroy', $trueFalse->id_asses) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada pertanyaan True/False yang terkait dengan cerita ini.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </section>

     <!-- Tabel Matching -->
    <div class="max-w-8xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-md">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Matching Question ({{ $story->title }})</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Here is the matching question related to this story.</p>
        </div>

        <a class="flex justify-end mb-3" href="{{ route('matching.create', ['story_id' => $story->story_id]) }}">
                <button class="bg-transparent hover:bg-green-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                    Add Question +
                </button>
            </a>

    @if($matching)
    <script id="matching"></script>
    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-2">Picture</th>
                <th scope="col" class="px-4 py-2">Name</th>
                <th scope="col" class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/' . $matching->picture_1) }}" alt="Picture 1" class="h-40 w-40 object-cover mx-auto">
                </td>
                <td class="px-4 py-2">{{ $matching->name_1 }}</td>
                <td class="px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                    <a href="{{ route('matching.edit', $matching->id_asses) }}">
                            <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                    </a>

                        <!-- Tombol Delete -->
                        <!-- <form action="{{ route('truefalse.destroy', $trueFalse->id_asses) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                        </form> -->
                    </div>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/' . $matching->picture_2) }}" alt="Picture 2" class="h-40 w-40 object-cover mx-auto">
                </td>
                <td class="px-4 py-2">{{ $matching->name_2 }}</td>
                <td class="px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                    <a href="{{ route('matching.edit', $matching->id_asses) }}">
                        <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                    </a>

                        <!-- Tombol Delete -->
                        <!-- <form action="{{ route('truefalse.destroy', $trueFalse->id_asses) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                        </form> -->
                    </div>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/' . $matching->picture_3) }}" alt="Picture 3" class="h-40 w-40 object-cover mx-auto">
                </td>
                <td class="px-4 py-2">{{ $matching->name_3 }}</td>
                <td class="px-6 py-4">
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                    <a href="{{ route('matching.edit', $matching->id_asses) }}">
                        <button type="button" class="w-full sm:w-auto text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Edit</button>
                    </a>

                        <!-- Tombol Delete -->
                        <!-- <form action="{{ route('truefalse.destroy', $trueFalse->id_asses) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full sm:w-auto text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                        </form> -->
                    </div>
                </td>
                
            </tr>
            
        </tbody>
    </table>
    @else
        <p class="text-center text-gray-500">No matching question for this story.</p>
    @endif
</div>

<script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
            return false;
        }
    </script>

    </x-app-layout>

    
        

