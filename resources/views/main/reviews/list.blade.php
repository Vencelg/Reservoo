@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.main')

@section('main-content')
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
            <div>
                <div class="flex justify-between items-center">
                <h1 class="text-2xl font-medium">Reviews</h1>
                <div class="max-w-xl">
                    <label for="sort" class="block mb-2 text-sm font-medium dark:text-white">Sort by</label>
                    <select id="sort" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="highest_rating">Highest Rating</option>
                        <option value="lowest_rating">Lowest Rating</option>
                        <option value="most_recent">Most Recent</option>
                        <option value="least_recent">Least Recent</option>
                    </select>
                </div>
                </div>
                <hr class="mt-5 w-full">
            </div>
            <div id="review_list">
                @foreach($reviews as $review)
                    <div data-rating="{{$review->rating}}" data-created-at="{{$review->created_at}}" class="review_object mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="gap-3 pb-6 sm:flex sm:items-start mt-5">
                            <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                                <div class="flex items-center gap-0.5">
                                    <svg class="h-4 w-4 @if($review->rating >= 1) text-yellow-300 @else text-gray-300 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>

                                    <svg class="h-4 w-4 @if($review->rating >= 2) text-yellow-300 @else text-gray-300 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>

                                    <svg class="h-4 w-4 @if($review->rating >= 3) text-yellow-300 @else text-gray-300 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>

                                    <svg class="h-4 w-4 @if($review->rating >= 4) text-yellow-300 @else text-gray-300 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>

                                    <svg class="h-4 w-4 @if($review->rating >= 5) text-yellow-300 @else text-gray-300 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                </div>

                                <div class="space-y-0.5">
                                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{$review->user->name}}</p>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{$review->created_at}}</p>
                                </div>
                            </div>

                            <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                                <h1>{{$review->title}}</h1>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$review->description}}</p>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const sort = document.getElementById('sort');

        sort.addEventListener('change', () => {
            applySort(sort.value);
        });

        function applySort(sort) {
            const reviews = Array.from(document.querySelectorAll('#review_list .review_object'));

            reviews.sort(function (a, b) {
                switch (sort) {
                    case 'lowest_rating':
                        return a.getAttribute('data-rating') - b.getAttribute('data-rating');
                    case 'most_recent':
                        return new Date(b.getAttribute('data-created-at')) - new Date(a.getAttribute('data-created-at'));
                    case 'least_recent':
                        return new Date(a.getAttribute('data-created-at')) - new Date(b.getAttribute('data-created-at'));
                    default:
                        return b.getAttribute('data-rating') - a.getAttribute('data-rating');
                }
            });

            const reviewList = document.getElementById('review_list');
            reviews.forEach(function (restaurant) {
                reviewList.appendChild(restaurant);
            });
        }
    </script>
@endsection
