<nav class="border-gray-200 bg-gray-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="logo.png" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">RuangKominfo</span>
        </a>
        <button data-collapse-toggle="navbar-hamburger" type="button" class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-hamburger" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full" id="navbar-hamburger">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50">
                <li>
                    <a href="/" class="block py-2 px-3 text-gray-800 bg-white hover:bg-gray-300 rounded" aria-current="page">Home</a>
                </li>
                <li>
                    @auth
                    <a href="{{ route('dashboard') }}" class="block py-2 px-3 text-gray-800 bg-white hover:bg-gray-300 rounded">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-800 bg-white hover:bg-gray-300 rounded">
                        Login
                    </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
<x-welcome-layout>

    <div>
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            {{-- Carousel Parts --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                @php
                $carousel = \App\Models\Room::get();
                $customTexts = [
                "RuangKominfo",
                "Media Perencanaan Kegiatan dan Ruangan",
                "Dinas Komunikasi dan Informasi Kabupaten Banyumas",
                ];
                @endphp
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        @foreach ($carousel as $index => $r)
                        <div class="hidden duration-700 ease-in-out {{ $index === 0 ? 'block' : '' }}" data-carousel-item>
                            <a href="{{ route('rooms.show', $r->id) }}">
                                <img src="{{ asset('storage/' . $r->image) }}" class="absolute block w-full h-full object-cover top-0 left-0" alt="{{ $r->nama_ruang }}">
                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                    <h2 class="text-2xl md:text-4xl text-white text-center">{{ $customTexts[$index % count($customTexts)] }}</h2>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        @foreach ($carousel as $index => $r)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>

                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>

            <!-- About Us Section -->
            <section class="bg-gray-100 py-16">
                <div class="container mx-auto flex flex-col md:flex-row items-center">
                    <!-- Left Side - Picture -->
                    <div class="md:w-1/3 w-full px-4 mb-8 md:mb-0">
                        <img src="logo.png" alt="About Us Image" class="w-full h-auto">
                    </div>
                    <!-- Right Side - Text Content -->
                    <div class="md:w-2/3 w-full px-4">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">About Us</h2>
                        <p class="text-md text-gray-600 mb-6 text-justify">
                            RuangKominfo adalah platform digital yang dirancang untuk memudahkan proses peminjaman ruang rapat di Dinas Komunikasi dan Informatika (Dinkominfo). Kami hadir untuk memberikan solusi yang efisien dan terintegrasi dalam mengelola kebutuhan ruang rapat, dengan tujuan menciptakan lingkungan kerja yang lebih terorganisir dan produktif. Melalui layanan kami, pengguna dapat dengan mudah mencari, memesan, dan mengelola jadwal ruang rapat, serta mendapatkan konfirmasi pemesanan secara real-time. RuangKominfo merupakan bagian dari upaya transformasi digital di Kominfo, yang terus berinovasi untuk memberikan layanan terbaik dan mendukung kolaborasi yang lebih efektif di lingkungan kerja. </p>
                    </div>
                </div>
            </section>



            {{-- Monthly Events Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-4 border">
                <form method="GET" action="/" class="mb-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="month" class="block text-sm font-medium text-gray-700">Select Month</label>
                            <input type="month" name="month" id="month" value="{{ request('month') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="self-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                        {{ \Carbon\Carbon::parse($monthStart)->format('F Y') }}
                    </h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-acara">
                                    Acara
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Peserta
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ruang
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penanggung Jawab
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mulai
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                <form action="{{ route('booking.destroy', $booking) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
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
    <footer class="bg-white rounded-lg shadow m-4">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="https://flowbite.com/" class="hover:underline">RuangKominfo™</a>. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 sm:mt-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
    </footer>
    </div>

</x-welcome-layout>
