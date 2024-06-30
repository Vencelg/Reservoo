@extends('layout.main')

@section('main-content')
    <div class="w-[80%] m-auto grid grid-cols-3 gap-5 justify-items-center">
    @if($restaurants)
        @foreach($restaurants as $restaurant)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-2xl shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <div style="background-image: url({{$restaurant->banner_url}});" class="h-[10rem] bg-cover bg-no-repeat rounded-t-2xl"></div>
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white pt-2">{{$restaurant->name}}</h5>
                    </a>
                    <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <p class="ms-2 text-sm font-bold text-gray-900 dark:text-white">{{$restaurant->rating}}</p>
                                <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                                <a class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{$restaurant->reviews}} reviews</a>
                            </div>
                    </div>
                    @foreach($restaurant->tags as $tag)
                        <span style="background-color: {{$tag->color}}" class="text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$tag->name}}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
    </div>
@endsection
