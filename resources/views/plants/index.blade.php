<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Plants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul role="list" class="divide-y divide-gray-100">
                    @for($i = 0; $i < 25; $i++)
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <a href="{!! route('plants.details', [$plants[$i]->slug]) !!}"><p class="text-sm leading-6 text-white-700">{{$plants[$i]->common_name}}</p></a>
                                    <p class="text-sm font-semibold leading-6 text-white-700">{{$plants[$i]->subkingdom}}</p>
                                    <p class="mt-1 truncate text-xs leading-5 text-white-500">{{$plants[$i]->kingdom}}</p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                            </div>
                        </li>
                    @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
