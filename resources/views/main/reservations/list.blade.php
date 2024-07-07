@php use Carbon\Carbon;use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.main')

@section('main-content')
    <?php
    $user = Auth::user();
    ?>
    <div class="min-h-full bg-gray-50">
        <div>
            <div class="bg-cover bg-center bg-no-repeat h-[40%]">
                <div class="bg-blue-600 h-full text-white pl-5 pb-5 flex justify-start items-center">
                    <svg class="w-[20%] h-[20%] group-hover:text-blue-600 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                              d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                              clip-rule="evenodd"/>
                    </svg>
                    <div class="ml-5">
                        <h1 class="text-5xl">{{$user->name}}</h1>
                        <div>
                            <p>{{$user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{route('home')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    Restaurants
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">My reservations</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    @if(session('success'))
                        <div id="alert-3"
                             class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                             role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                {{session('success')}}
                            </div>
                            <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                    <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                            Your reservations
                        </h2>
                        <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">

                        </div>
                    </div>

                    <div class="mt-6 flow-root sm:mt-8">
                        <div id="table_list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($reservations as $reservation)
                                <div class="table_object flex flex-wrap items-center gap-y-4 py-6">
                                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Restaurant
                                            name:
                                        </dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{$reservation->table->restaurant->name}}</dd>
                                    </dl>

                                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reserved_from)->format('d/m/y')}}</dd>
                                    </dl>

                                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Time:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reserved_from)->format('H:i')}}
                                            - {{Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reserved_to)->format('H:i')}}</dd>
                                    </dl>

                                    <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                        <form action="{{route('reservations.destroy', ['id' => $reservation->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="w-full rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 lg:w-auto">
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <div id="not_found_block" class="col-span-3 w-full bg-gray-50 text-gray-300 rounded-2xl text-center p-4">
                                    <svg class="w-1/12 m-auto fill-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M175.9 448c-35-.1-65.5-22.6-76-54.6C67.6 356.8 48 308.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208s-93.1 208-208 208c-28.4 0-55.5-5.7-80.1-16zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM128 369c0 26 21.5 47 48 47s48-21 48-47c0-20-28.4-60.4-41.6-77.7c-3.2-4.4-9.6-4.4-12.8 0C156.6 308.6 128 349 128 369zm128-65c-13.3 0-24 10.7-24 24s10.7 24 24 24c30.7 0 58.7 11.5 80 30.6c9.9 8.8 25 8 33.9-1.9s8-25-1.9-33.9C338.3 320.2 299 304 256 304zm47.6-96a32 32 0 1 0 64 0 32 32 0 1 0 -64 0zm-128 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                                    <h1 class="pt-5 font-medium">You have no reservations yet</h1>
                                </div>
                                @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
