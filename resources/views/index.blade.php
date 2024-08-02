@extends('layout.main')

@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 mr-2 bg-gray-100 dark:bg-gray-800 sm:rounded-lg">
                        <h1 class="text-4xl sm:text-5xl text-black dark:text-white font-extrabold tracking-tight">
                            sherldoc
                        </h1>
                        <p class="text-normal text-lg sm:text-2xl font-medium text-black dark:text-white">
                            inspect your docs
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2">
                    <div class="p-6 mr-2">
                        <form action="/scan" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="ensure_existing">Ensure existing keywords</label>
                            <textarea name="ensure_existing"
                                      class=" text-black"
                                      id="ensure_existing"
                                      cols="30" rows="4">
legal
binding
obviously wrong
                            </textarea>
                            <br/>
                            <label for="ensure_missing">Ensure missing keywords</label>
                            <textarea name="ensure_missing"
                                      class=" text-black"
                                      id="ensure_missing"
                                      cols="30" rows="4">
agreement
perpetuity
expressly
prohibited
free software
                            </textarea>
                            <br/>
                            <label for="prompt">Question to ask</label>
                            <br/>
                            <input type="text" name="prompt" id="prompt"
                                   class="w-full text-black"
                            value="Are there any areas in this agreement that are potentially contradictory?"
                            />
                            <br/>
                            <br/>
                            <input type="file" name="file" id="file">
                            <br/>
                            <input type="submit"
                                   class="mt-4 rounded-lg bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4"
                                   value="Scan">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

