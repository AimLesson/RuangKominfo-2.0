<x-welcome-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Carousel Parts --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                @php
                    $carousel = \App\Models\Room::get();
                @endphp
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        @foreach ($carousel as $index => $r)
                            <div class="hidden duration-700 ease-in-out {{ $index === 0 ? 'block' : '' }}"
                                data-carousel-item>
                                <a href="{{ route('rooms.show', $r->id) }}">
                                    <img src="{{ asset('storage/' . $r->image) }}"
                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                        alt="{{ $r->nama_ruang }}">
                                    <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 text-white p-4">
                                        <h3 class="text-lg">{{ $r->nama_ruang }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        @foreach ($carousel as $index => $r)
                            <button type="button" class="w-3 h-3 rounded-full"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"
                                data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>

                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>

            {{-- Monthly Events Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-4">
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="month" class="block text-sm font-medium text-gray-700">Select Month</label>
                            <input type="month" name="month" id="month" value="{{ request('month') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="self-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filter
                            </button>
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Login
                                </a>
                            @endauth
                        </div>
                    </div>
                </form>

                @php
                    $selectedMonth = request('month', now()->format('Y-m'));
                    $monthStart = \Carbon\Carbon::parse($selectedMonth)->startOfMonth()->format('Y-m-d');
                    $monthEnd = \Carbon\Carbon::parse($selectedMonth)->endOfMonth()->format('Y-m-d');
                    $monthlyEvents = \App\Models\Event::where('status', 'Disetujui') // Filter by status
                        ->whereBetween('date', [$monthStart, $monthEnd])
                        ->get();
                @endphp

                <div class="p-4 relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
                    <h3 class="uppercase text-lg font-semibold text-gray-800 mb-4">Jadwal Kegiatan Bulanan -
                        {{ \Carbon\Carbon::parse($monthStart)->format('F Y') }}</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-acara">
                                    Acara
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Peserta
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ruang
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penanggung Jawab
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mulai
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Selesai
                                </th>
                                {{-- <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th> --}}
                                {{-- @if (Auth::user()->role == 'admin')
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($monthlyEvents as $booking)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-acara">
                                        {{ $booking->acara }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->peserta }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->nama_rooms }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->nama }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->asalbidang }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->start }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $booking->finish }}
                                    </td>
                                    {{-- <td class="px-6 py-4 text-sm text-gray-900">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($booking->status == 'Menunggu Konfirmasi') bg-yellow-100 text-yellow-800
                                        @elseif ($booking->status == 'Disetujui')
                                            bg-green-100 text-green-800
                                        @elseif ($booking->status == 'Tidak Disetujui')
                                            bg-red-100 text-red-800 @endif
                                    ">
                                            {{ $booking->status }}
                                        </span>
                                    </td> --}}
                                    {{-- @if (Auth::user()->role == 'admin')
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <div class="flex">
                                                <a href="{{ route('booking.edit', $booking) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('booking.destroy', $booking) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-welcome-layout>
