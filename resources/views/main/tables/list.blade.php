@extends('layout.main')

@section('main-content')
    @if(session('errors'))
        @dd(session('errors'))
    @endif
    <div class="h-screen bg-gray-50">
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

        <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Reserve a table</h2>
                        <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                                <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="reservation_date" name="reservation_date" datepicker-format="dd/mm/yyyy" datepicker datepicker-autohide datepicker-buttons type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>
                            <div>
                                <label for="seats" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
                                <select id="seats" name="seats" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                    @foreach($restaurant->getAvailableSeats() as $seat)
                                        <option value="{{$seat}}">{{$seat}} seats</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="reservation_start" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
                                <select id="reservation_start" name="reservation_start" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                    @foreach($restaurant->getTimeslots() as $time)
                                        <option value="{{$time}}">{{$time}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <span class="inline-block text-gray-500 dark:text-gray-400"> - </span>

                            <div>
                                <label for="reservation_end" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select duration</label>
                                <select data-max-reservation="{{$restaurant->max_reservation_time}}" data-restaurant-available-times="{{json_encode($restaurant->getTimeslots())}}" id="reservation_end" name="reservation_end" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                                    <?php
                                        $timeslots = $restaurant->getTimeslots();
                                        array_shift($timeslots);
                                    ?>
                                    @foreach($timeslots as $time)
                                        <option value="{{$time}}">{{$time}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flow-root sm:mt-8">
                        <div id="table_list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($tables as $table)
                                <div data-seats="{{$table->seats}}" data-available-times="{{json_encode($table->getAvailableTimes())}}" class="table_object flex flex-wrap items-center gap-y-4 py-6">
                                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Table code:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{$table->code}}</dd>
                                    </dl>

                                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Seats:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{$table->seats}}</dd>
                                    </dl>

                                    <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                        <form action="{{route('reservations.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="table_id" value="{{$table->id}}">
                                            <button type="submit" class="w-full rounded-lg bg-blue-700 px-3 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 lg:w-auto">Reserve</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
        const seatsSelect = document.getElementById('seats');
        const reservationStartSelect = document.getElementById('reservation_start');
        const reservationEndSelect = document.getElementById('reservation_end');
        const reservationDateSelect = document.getElementById('reservation_date');
        const urlParams = new URLSearchParams(window.location.search);
        const date = urlParams.get('date') ? new Date(urlParams.get('date')) : new Date();

        window.addEventListener('load', () => {
            reservationDateSelect.value = `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`;
            applyFilters();
            renderEndTimes();
            addEventToForms();
        });

        seatsSelect.addEventListener('change', () => {
            applyFilters();
        });

        reservationStartSelect.addEventListener('change', () => {
            applyFilters();
            renderEndTimes();
        });

        reservationEndSelect.addEventListener('change', () => {
            applyFilters();
        });

        reservationDateSelect.addEventListener('changeDate', () => {
            const [day, month, year] = reservationDateSelect.value.split('/');
            const formattedDate = `${month}-${day}-${year}`;
            window.location.href = `{{route('tables.list', ['id' => $restaurant->id])}}?date=${formattedDate}`
        });

        function applyFilters() {
            const tables = Array.from(document.querySelectorAll('#table_list .table_object'));
            tables.forEach(function(table) {
                const availableTimes = JSON.parse(table.getAttribute('data-available-times'));
                const seats = table.getAttribute('data-seats');

                const matchesSeats = !seats || seats === seatsSelect.value
                const matchesReservationStart = !availableTimes || availableTimes.includes(reservationStartSelect.value)
                const matchesReservationEnd = !availableTimes || availableTimes.includes(reservationEndSelect.value)

                if (matchesSeats && matchesReservationStart && matchesReservationEnd) {
                    table.style.display = '';
                } else {
                    table.style.display = 'none';
                }
            });
        }

        function renderEndTimes() {
            const reservationAvailableTimes = JSON.parse(reservationEndSelect.getAttribute('data-restaurant-available-times'));
            const maxReservationTime = parseInt(reservationEndSelect.getAttribute('data-max-reservation'))
            reservationEndSelect.innerHTML = '';
            const minEndTime = new Date(`1970-01-01T${reservationStartSelect.value}:00`);
            minEndTime.setMinutes(minEndTime.getMinutes() + 30);
            const maxEndTime = new Date(`1970-01-01T${reservationStartSelect.value}:00`);
            maxEndTime.setHours(maxEndTime.getHours() + maxReservationTime);

            reservationAvailableTimes.forEach(time => {
                const timeDate = new Date(`1970-01-01T${time}:00`);
                if (timeDate >= minEndTime && timeDate <= maxEndTime) {
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    reservationEndSelect.appendChild(option);
                }
            });
        }

        function addEventToForms() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // getMonth() is zero-based
                    const day = String(date.getDate()).padStart(2, '0');

                    const reservationStart = document.createElement('input');
                    reservationStart.type = 'hidden';
                    reservationStart.name = 'reserved_from';
                    reservationStart.value = `${year}-${month}-${day} ${reservationStartSelect.value}:00`;

                    const reservationEnd = document.createElement('input');
                    reservationEnd.type = 'hidden';
                    reservationEnd.name = 'reserved_to';
                    reservationEnd.value = `${year}-${month}-${day} ${reservationEndSelect.value}:00`;

                    form.appendChild(reservationStart);
                    form.appendChild(reservationEnd);

                    form.submit();
                });
            });
        }
    </script>
@endsection
