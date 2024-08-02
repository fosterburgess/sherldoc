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
                        <h2 class="text-xl font-semibold text-black dark:text-white">Found unexpected keywords</h2>

                        <p class="mt-4 text-sm/relaxed">
                            @php
                                if(count($output['found']['words']) == 0) {
                                    echo 'No unexpected keywords found';
                                } else {
                                    foreach($output['found']['words'] as $result=>$details) {
                                    ?>
                                    <span class="text-red-500"><?=$result ;?></span>
                                    <?php
                                    foreach($details as $page=>$count) {
                                        ?>
                                        on page <?= $page;?> <?= $count ;?> times<br/>
                                        <?php
                                    }
                                    }
                                }
                            @endphp
                        </p>

                        <h2 class="mt-8 text-xl font-semibold text-black dark:text-white">Expected keywords missing</h2>

                        <p class="mt-4 text-sm/relaxed">
                            @php
                                if(count($output['missing']) == 0) {
                                    echo 'No expected keywords missing';
                                } else {
                                    foreach($output['missing'] as $result=>$details) {
                                    ?>
                                    <span class="text-red-500"><?=$details;?></span><br/>
                                    <?php
                                    }
                                }
                            @endphp
                        </p>
                    </div>
                    <div class="p-6 mr-2">

                        <h2 class=" text-xl font-semibold text-black dark:text-white">Response</h2>
                        <p>
                            To the question <?=$prompt;?>
                        </p>
                        <p class="mt-4 text-md text-black">
                            {!! nl2br($llmResponse)  !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

