@extends('layout.main')

@section('main-content')
    <div class="pt-4 w-[80%] m-auto">
        <div class="w-full bg-blue-600 p-5 rounded-2xl mb-5 flex xl:justify-between xl:items-end xl:flex-row flex-col justify-center items-center">
            <div class="flex xl:w-2/3 xl:mb-0 xl:mr-5 w-full md:mr-0 md:mb-2">
                <div class="w-full">
                        <label for="search" class="block mb-2 text-sm font-medium text-white dark:text-white md:w-full">Search restaurants</label>
                    <div class="relative w-full">
                        <input type="search" id="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="What are you looking for..." required />
                    </div>
                </div>
            </div>

            <div class="flex justify-between w-full xl:flex-row xl:w-1/3 sm:w-full flex-col">
                <div>
                    <label for="cuisine" class="block mb-2 text-sm font-medium text-white dark:text-white">Select a cuisine</label>
                    <select id="cuisine" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>All cuisines</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sort" class="block mb-2 text-sm font-medium text-white dark:text-white">Sort by</label>
                    <select id="sort" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="name" selected>Name</option>
                        <option value="highest_rating">Highest Rating</option>
                        <option value="lowest_rating">Lowest Rating</option>
                        <option value="most_reviews">Most Reviews</option>
                        <option value="least_reviews">Least Reviews</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="restaurantList" class="grid lg:grid-cols-3 gap-5 justify-items-center md:grid-cols-2 sm:grid-cols-1">
            <div id="not_found_block" style="display: none" class="col-span-3 w-full bg-blue-600 text-white rounded-2xl text-center p-4">
                <svg class="w-1/12 m-auto fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M175.9 448c-35-.1-65.5-22.6-76-54.6C67.6 356.8 48 308.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208s-93.1 208-208 208c-28.4 0-55.5-5.7-80.1-16zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM128 369c0 26 21.5 47 48 47s48-21 48-47c0-20-28.4-60.4-41.6-77.7c-3.2-4.4-9.6-4.4-12.8 0C156.6 308.6 128 349 128 369zm128-65c-13.3 0-24 10.7-24 24s10.7 24 24 24c30.7 0 58.7 11.5 80 30.6c9.9 8.8 25 8 33.9-1.9s8-25-1.9-33.9C338.3 320.2 299 304 256 304zm47.6-96a32 32 0 1 0 64 0 32 32 0 1 0 -64 0zm-128 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                <h1>Sorry, we could't find what you were looking for...</h1>
            </div>
                @forelse($restaurants as $restaurant)
                    <div data-name="{{$restaurant->name}}" data-rating="{{$restaurant->getRating()}}" data-reviews="{{$restaurant->reviews_count}}" class="restaurant_object transition-all duration-[90ms] hover:outline outline-blue-600 outline-offset-2 outline-4 w-full bg-blue-50 rounded-2xl shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{route('restaurants.detail', ['id' => $restaurant->id])}}">
                            <div style="background-image: url({{$restaurant->banner_url}});" class="h-[10rem] bg-cover bg-no-repeat rounded-t-2xl"></div>
                        </a>
                        <div class="px-5 pb-5">
                            <a href="{{route('restaurants.detail', ['id' => $restaurant->id])}}">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white pt-2">{{$restaurant->name}}</h5>
                            </a>
                            <div class="flex items-center mt-2.5 mb-5">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <p class="ms-2 text-sm font-bold text-gray-900 dark:text-white">{{$restaurant->getRating()}}</p>
                                    <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                                    <a href="{{route('reviews.list', ['id' => $restaurant->id])}}" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{$restaurant->reviews_count}} reviews</a>
                                </div>
                            </div>
                            <div id="tagList">
                                @foreach($restaurant->tags as $tag)
                                    <span data-id="{{$tag->id}}" style="background-color: {{$tag->color}}" class="tag_object text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$tag->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                <div class="col-span-3 w-full bg-blue-600 text-white rounded-2xl text-center p-4">
                    <svg class="w-1/12 m-auto fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M175.9 448c-35-.1-65.5-22.6-76-54.6C67.6 356.8 48 308.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208s-93.1 208-208 208c-28.4 0-55.5-5.7-80.1-16zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM128 369c0 26 21.5 47 48 47s48-21 48-47c0-20-28.4-60.4-41.6-77.7c-3.2-4.4-9.6-4.4-12.8 0C156.6 308.6 128 349 128 369zm128-65c-13.3 0-24 10.7-24 24s10.7 24 24 24c30.7 0 58.7 11.5 80 30.6c9.9 8.8 25 8 33.9-1.9s8-25-1.9-33.9C338.3 320.2 299 304 256 304zm47.6-96a32 32 0 1 0 64 0 32 32 0 1 0 -64 0zm-128 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
                    <h1>Sorry, we couldnt find what you were looking for...</h1>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        const search = document.getElementById('search');
        const sort = document.getElementById('sort');
        const cuisine = document.getElementById('cuisine');

        search.addEventListener('input', () => {
            applySearchAndCuisine(search.value.toLowerCase(), cuisine.value);
        });

        sort.addEventListener('change', () => {
            applySort(sort.value);
        });

        cuisine.addEventListener('change', () => {
            applySearchAndCuisine(search.value.toLowerCase(), cuisine.value);
        });

        function applySearchAndCuisine(search, selectedTag) {
            const restaurants = Array.from(document.querySelectorAll('#restaurantList .restaurant_object'));

            restaurants.forEach(function(restaurant) {
                const name = restaurant.getAttribute('data-name').toLowerCase();
                const tags = Array.from(restaurant.querySelectorAll('#tagList .tag_object')).map(tag => tag.getAttribute('data-id'));

                const matchesTag = !selectedTag || tags.includes(selectedTag);
                const matchesSearch = name.includes(search);

                if (matchesSearch && matchesTag) {
                    restaurant.style.display = '';
                } else {
                    restaurant.style.display = 'none';
                }
            });

            const notFoundBlock = document.getElementById('not_found_block');
            const visibleRestaurants = restaurants.filter(function (restaurant) {
                return restaurant.style.display !== 'none';
            });

            if (visibleRestaurants.length === 0) {
                notFoundBlock.style.display = '';
            }else {
                notFoundBlock.style.display = 'none';
            }
        }

        function applySort(sort) {
            const restaurants = Array.from(document.querySelectorAll('#restaurantList .restaurant_object'));

            restaurants.sort(function (a, b) {
                switch (sort) {
                    case 'most_reviews':
                        return b.getAttribute('data-reviews') - a.getAttribute('data-reviews');
                    case 'highest_rating':
                        return b.getAttribute('data-rating') - a.getAttribute('data-rating');
                    case 'least_reviews':
                        return a.getAttribute('data-reviews') - b.getAttribute('data-reviews');
                    case 'lowest_rating':
                        return a.getAttribute('data-rating') - b.getAttribute('data-rating');
                    default:
                        return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                }
            });

            const restaurantList = document.getElementById('restaurantList');
            restaurants.forEach(function (restaurant) {
                restaurantList.appendChild(restaurant);
            });
        }

        function showNotFound() {
            const notFondBlock = document.getElementById('#not_found_block');
            const restaurants = Array.from(document.querySelectorAll('#restaurantList .restaurant_object'));
            const visibleRestaurants = restaurants.filter(function (restaurant) {
                return restaurant.style.display !== 'none';
            });
            console.log(notFondBlock)

            if (visibleRestaurants.length === 0) {
                notFondBlock.style.display = '';
            }else {
                notFondBlock.style.display = 'none';
            }
        }
    </script>
@endsection
