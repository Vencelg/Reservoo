@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.main')

@section('main-content')
    <style>
        .rating_star:hover,
        .rating_star.selected {
            fill: rgb(250, 202, 21);
        }
    </style>
    <div class="bg-gray-50">
        <div style="background-image: url({{$restaurant->banner_url}})" class="bg-cover bg-center bg-no-repeat h-[40vh]">
            <div class="bg-black bg-opacity-50 h-full text-white pl-5 pb-5 flex justify-start items-end">
                <h1 class="text-5xl">{{$restaurant->name}}</h1>
                <div class="flex items-center ml-3 mb-2">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <p class="ms-2 text-sm font-bold text-white dark:text-white">{{$restaurant->getRating()}}</p>
                        <span class="w-1 h-1 mx-1.5 bg-white rounded-full dark:bg-gray-400"></span>
                        <a href="{{route('reviews.list', ['id' => $restaurant->id])}}" class="text-sm font-medium text-white underline hover:no-underline dark:text-white">{{$restaurant->reviews_count}} reviews</a>
                    </div>
                </div>
                <div class="flex justify-center items-center ml-3 mb-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2 fill-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{$restaurant->opening_time}} </span>
                    -
                    <span> {{$restaurant->closing_time}}</span>
                </div>
            </div>
        </div>
        <div class="w-[80%] m-auto mt-10 bg-gray-50">
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
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{$restaurant->name}}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div>
                <h1 class="text-2xl font-medium">About</h1>
                <hr class="my-5">
                <p class="text-justify">{{$restaurant->bio}}</p>
            </div>

            <div class="mt-10">
                <a href="{{route('tables.list', ['id' => $restaurant->id])}}">
                    <button type="button" class="w-full rounded-lg bg-blue-700 px-3 py-2  font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 lg:w-auto">Make reservation</button>
                </a>
            </div>

            <div class="flex flex-col justify-between items-start py-16">
                <h1 class="text-2xl font-medium">Contact</h1>
                <hr class="my-5 w-full">
                <div class="flex justify-between items-center w-full">
                    <div>
                        <div class="mb-5">
                            <p class="text-justify font-medium">{{$restaurant->email}}</p>
                            <p class="text-justify font-medium">{{$restaurant->phone_number}}</p>
                        </div>
                        <div>
                            <p class="text-justify">{{$restaurant->street}}</p>
                            <p class="text-justify">{{$restaurant->city}}</p>
                            <p class="text-justify">{{$restaurant->postcode}}</p>
                        </div>
                    </div>
                    <div>
                        <x-maps-leaflet
                            style="width: 350px; height: 250px;"
                            :centerPoint="['lat' => $restaurant->latitude, 'long' => $restaurant->longitude]"
                            :markers="[['lat' => $restaurant->latitude, 'long' => $restaurant->longitude]]"
                            :zoom-level="20"
                        >
                        </x-maps-leaflet>
                    </div>
                </div>
            </div>

            <div id="review_form" class="py-8 px-4 mx-auto w-full lg:py-16">
                @if(session('errors'))
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{session('errors')}}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
                <h1 class="text-2xl font-medium">Leave a review</h1>
                <hr class="my-5 w-full">
                <form action="{{route('reviews.store')}}" method="post">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::id()}}">
                    <input type="hidden" id="restaurant_id" name="restaurant_id" value="{{$restaurant->id}}">

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Review title" required="">
                        </div>
                        <div class="w-full">
                            <label for="rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a rating</label>
                            <input type="hidden" id="rating" name="rating">
                            <div class="flex">
                                <svg data-rating="1" class="rating_star cursor-pointer w-8 h-8 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg data-rating="2" class="rating_star cursor-pointer w-8 h-8 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg data-rating="3" class="rating_star cursor-pointer w-8 h-8 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg data-rating="4" class="rating_star cursor-pointer w-8 h-8 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <svg data-rating="5" class="rating_star cursor-pointer w-8 h-8 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Submit review
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function () {
            const stars = document.querySelectorAll('.rating_star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('mouseover', function () {
                    highlightStars(star.getAttribute('data-rating'));
                });

                star.addEventListener('mouseout', function () {
                    resetStars();
                });

                star.addEventListener('click', function () {
                    ratingInput.value = star.getAttribute('data-rating');
                    setRating(star.getAttribute('data-rating'));
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-rating') <= rating) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }

            function resetStars() {
                stars.forEach(star => {
                    if (!star.classList.contains('clicked')) {
                        star.classList.remove('selected');
                    }
                });
            }

            function setRating(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-rating') <= rating) {
                        star.classList.add('clicked');
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('clicked');
                        star.classList.remove('selected');
                    }
                });
            }
        });
    </script>
@endsection
