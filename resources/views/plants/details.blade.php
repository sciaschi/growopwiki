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
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-md leading-6 text-white-700">
                                        Common Name
                                        <p class="text-sm">{{$plant->common_name}}</p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Active Growth Period
                                        <p class="text-sm">{{$details->active_growth_period}} <i class="fa-solid fa-fan"></i> <i class="fa-solid fa-sun"></i></p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Growth Rate
                                        <progress-bar text="{{$details->growth_rate}}" current-step="3"></progress-bar>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Drought Tolerance
                                        <progress-bar text="{{$details->drought_tolerance}}" current-step="1"></progress-bar>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Fertility Requirement
                                        <progress-bar text="{{$details->fertility_requirement}}" current-step="2"></progress-bar>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Adapted Coarse soil
                                        <p class="text-sm">
                                            {!! $details->adapted_fine_soil ? 'Yes <span class="fa-regular fa-circle-check"></span>' : 'No <i class="fa-regular fa-circle-xmark"></i>' !!}
                                        </p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Adapted Fine soil
                                        <p class="text-sm">
                                            {!! $details->adapted_fine_soil ? 'Yes <span class="fa-regular fa-circle-check"></span>' : 'No <i class="fa-regular fa-circle-xmark"></i>' !!}
                                        </p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Adapted to Medium soil
                                        <p class="text-sm">
                                            {!! $details->adapted_medium_soil ? 'Yes <span class="fa-regular fa-circle-check"></span>' : 'No <i class="fa-regular fa-circle-xmark"></i>' !!}
                                        </p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Minimum pH
                                        <p class="text-sm">{{$details->ph_min}}</p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Maximum pH
                                        <p class="text-sm">{{$details->ph_max}}</p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Temperature Minimum
                                        <p class="text-sm">{{number_format($details->temp_min, 1)}}°F</p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Mature Height
                                        <p class="text-sm">{{$details->mature_height}} ft</p>
                                    </p>
                                    <p class="text-md leading-6 text-white-700">
                                        Minimum Root Depth
                                        <p class="text-sm">{{number_format($details->root_depth,1)}} in</p>
                                    </p>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
