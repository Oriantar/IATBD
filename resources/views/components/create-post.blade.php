<section class="mx-auto max-w-4xl rounded-md bg-green-600 p-6 shadow-md">
    <button class="vakje-knop" onclick="toggleVakje()"><h2 class="text-lg font-semibold text-white">Upload your own animal!</h2></button>
    <div class="vakje">
        <button class="vakje-knop" onclick="toggleVakje()"></button>
        <div class="hidden" id="vakje-inhoud">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 grid grid-cols-1 gap-6">
                    <div>
                        <label class="text-white" for="username">Username</label>
                        <input id="pet" name="pet" type="text"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300" />
                    </div>

                    <div>
                        <div class="w-full mt-4">
                            <label class="text-white">Description</label>
                            <textarea
                                class="block w-full h-32 px-5 py-2.5 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg md:h-56 dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                placeholder="Description" name="message" id="message"></textarea>
                        </div>
                    </div>
                    <div>

                        <label class="text-white" for="password">Amount</label>
                        <input id="bedrag" name="bedrag" type="text"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300"
                            placeholder="0.00" />
                    </div>



                    <div class="date-picker flex justify- justify-center space-x-2 my-4">
                        <label class="text-white">StartDate</label>
                        <input Blocked type="date" id="starthuur" name="starthuur" placeholder="Start Date" required
                            class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent text-green-600 px-4 py-2">
                        <label class="text-white">EndDate</label>
                        <input type="date" id="eindhuur" name="eindhuur" placeholder="End Date" required
                            class="border-gray-300 mx-2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm dark:bg-transparent text-green-600 px-4 py-2">
                    </div>

                    <div class="justify-self-center">

                        <label class="text-white" for="species">Species</label>
                        <select class="rounded-md px-4 py-2 text-green-600" name="species" id="species">
                            @foreach ($species as $kind)
                                <option value="{{ $kind->kind }}">{{ $kind->kind }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div>
                        <label for="file" class="text block text-white">File</label>

                        <label for="dropzone-file"
                            class="mx-auto mt-2 flex w-full max-w-lg cursor-pointer flex-col items-center rounded-xl border-2 border-dashed border-gray-300 bg-white p-5 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>

                            <h2 class="mt-1 font-medium tracking-wide text-gray-700">Picture of pet</h2>

                            <p class="mt-2 text-xs tracking-wide text-gray-500">Upload or drag & drop your file SVG,
                                PNG, JPG or
                                GIF.</p>

                            <input id="dropzone-file" type="file" name="image" class="hidden" />
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="transform rounded-md bg-white px-8 py-2.5 leading-5 text-green-600 transition-colors duration-300  focus:outline-none">Save</button>
                </div>
            </form>
        </div>
    </div>
</section>
