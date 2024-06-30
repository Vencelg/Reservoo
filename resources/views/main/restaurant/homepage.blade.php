@extends('layout.main')

@section('main-content')
    <div class="w-[80%] m-auto">
        <form action="" class="w-full bg-blue-600 p-5 rounded-2xl mb-5">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="What would you like today?" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div class="grid grid-cols-3 gap-5 justify-items-center">
            @if($restaurants)
                @foreach($restaurants as $restaurant)
                    <div class="transition-all duration-[90ms] hover:outline outline-blue-600 outline-offset-2 outline-4 w-full bg-white rounded-2xl shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{route('restaurant.detail', ['id' => $restaurant->id])}}">
                            <div style="background-image: url({{$restaurant->banner_url}});" class="h-[10rem] bg-cover bg-no-repeat rounded-t-2xl"></div>
                        </a>
                        <div class="px-5 pb-5">
                            <a href="{{route('restaurant.detail', ['id' => $restaurant->id])}}">
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
    </div>
@endsection
