@extends('layout.main')

@section('main-content')
    <div class="h-screen">
        <div style="background-image: url({{$restaurant->banner_url}})" class="bg-cover bg-center bg-no-repeat h-[40%]">
            <div class="bg-black bg-opacity-50 h-full text-white pl-5 pb-5 flex justify-start items-end">
                <h1 class="text-5xl">{{$restaurant->name}}</h1>
                <div class="flex items-center ml-3 mb-2">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        <p class="ms-2 text-sm font-bold text-white dark:text-white">{{$restaurant->rating}}</p>
                        <span class="w-1 h-1 mx-1.5 bg-white rounded-full dark:bg-gray-400"></span>
                        <a class="text-sm font-medium text-white hover:no-underline dark:text-white">{{$restaurant->reviews}} reviews</a>
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
        <div class="w-[80%] m-auto mt-10 grid grid-cols-2 gap-5 justify-items-end">
            <div class="bg-blue-600 rounded-2xl p-5 h-full flex justify-between flex-col">
                <p class="text-white mb-5">
                    {{$restaurant->bio}}
                </p>
                <a href="{{route('tables.list', ['id' => $restaurant->id])}}"><button type="button" class="w-1/3 bg-white text-blue-600 hover:bg-gray-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Reserve now</button></a>
            </div>
            <div class="bg-blue-600 text-white p-5 rounded-2xl flex justify-evenly items-center w-full h-full">
                <div class="w-fit pr-5">
                    <p>{{$restaurant->street}}</p>
                    <p>{{$restaurant->city}}</p>
                    <p>{{$restaurant->postcode}}</p>
                </div>
                <x-maps-leaflet
                    style="width: 100%; height: 100%"
                    :centerPoint="['lat' => $restaurant->latitude, 'long' => $restaurant->longitude]"
                    :markers="[['lat' => $restaurant->latitude, 'long' => $restaurant->longitude]]"
                    :zoomLevel="20">>
                </x-maps-leaflet>
            </div>
        </div>
    </div>
@endsection
