<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- History User --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 p-4">
                @php
                    $jadwal = \App\Models\Event::where('id_rooms', $room->id)
                        ->where('status', 'Disetujui')
                        ->orderBy('date', 'asc')
                        ->get();
                @endphp

                <div class="p-4 relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
                    <h3 class="uppercase text-lg font-semibold text-gray-800 mb-4">Jadwal Kegiatan
                        {{ $user->name }}</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-acara">
                                    Acara</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                    Kode Presensi</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                    Jumlah Peserta</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ruang</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengguna</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mulai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Selesai</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($jadwal as $booking)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-acara whitespace-nowrap">
                                        {{ $booking->acara }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        <div id="qrcode-{{ $booking->id }}" class="cursor-pointer"
                                            onclick="showQRCode('{{ $booking->presensi }}')"></div>
                                        <script>
                                            new QRCode(document.getElementById("qrcode-{{ $booking->id }}"), "{{ $booking->presensi }}");
                                        </script>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $booking->peserta }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $booking->nama_rooms }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $booking->asalbidang }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $booking->start }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $booking->finish }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($booking->status == 'Menunggu Konfirmasi') bg-yellow-100 text-yellow-800
                                            @elseif ($booking->status == 'Disetujui') bg-green-100 text-green-800
                                            @elseif ($booking->status == 'Tidak Disetujui') bg-red-100 text-red-800 @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-medium whitespace-nowrap">
                                        <div class="flex">
                                            <a href="{{ route('booking.edit', $booking) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('booking.destroy', $booking) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal structure -->
                                <div id="qrCodeModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                    <div class="flex items-center justify-center min-h-screen">
                                        <div class="relative bg-white rounded-lg shadow-lg w-3/4 max-w-md">
                                            <div class="p-4 flex justify-between items-center border-b">
                                                <h3 class="text-lg font-semibold text-gray-900">Presensi Kegiatan
                                                    {{ $booking->acara }}</h3>
                                                <button class="text-gray-400 hover:text-gray-900"
                                                    onclick="closeModal()">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-4 flex justify-center items-center">
                                                <div id="modal-qrcode"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('booking.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                    Tambah Jadwal
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        function showQRCode(code) {
            document.getElementById('qrCodeModal').classList.remove('hidden');
            const modalQRCode = document.getElementById('modal-qrcode');
            modalQRCode.innerHTML = '';
            new QRCode(modalQRCode, {
                text: code,
                width: 400,
                height: 400
            });
        }

        function closeModal() {
            document.getElementById('qrCodeModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
