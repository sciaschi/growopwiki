<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Plants') }}
        </h2>
    </x-slot>

    <div class="py-12 grid grid-cols-12">
        <div id="filters-container" class="col-span-2 sm:px-2 lg:px-4 inline">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight text-center">
                        {{ __('Filters') }}
                    </h3>
                    <ul id="filters-list" class="w-28" role="list">
                        <li class="flex justify-between gap-x-6 py-5">

                        </li>
                        <li class="flex justify-between gap-x-6 py-5">

                        </li>
                        <li class="flex justify-between gap-x-6 py-5">

                        </li>
                        <li class="flex justify-between gap-x-6 py-5">

                        </li>
                        <li class="flex justify-between gap-x-6 py-5">

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sm:px-2 lg:px-4 inline col-span-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul role="list" class="divide-y divide-gray-100 overflow-y-scroll overflow-x-hidden h-screen">
                    @for($i = 0; $i < count($plants); $i++)
                        <li class="justify-between gap-x-6 py-5">
                            <div class="gap-x-4">
                                <div class="inline-flex">
                                    <img src="https://picsum.photos/200/200" class="rounded-md">
                                    <div class="inline-block pl-4 pt-4">
                                        <h1 class="text-4xl font-semibold leading-6 text-white-700">{{$plants[$i]->common_name}}</h1>
                                        <p class="text-lg mt-2 truncate leading-5 text-gray-500">{{$plants[$i]->scientific_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
