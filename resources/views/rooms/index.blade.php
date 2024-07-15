<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Auth::user()->role == 'admin')
                <div class="flex mb-2">
                    <button id="downloadPDF" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 focus:outline-none">
                        Download PDF
                    </button>
                    <a href="{{ route('rooms.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                        Tambah Ruangan
                    </a>
                </div>
            @endif
            <div id="rooms-list" class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($rooms as $room)
                    <div class="room-card max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                        <a href="{{ route('rooms.show', $room) }}">
                            <img class="rounded-t-lg" src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" />
                        </a>
                        <div class="p-5">
                            <a href="{{ route('rooms.show', $room) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $room->nama_ruang }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">{{ $room->deskripsi }}</p>
                            <p class="mb-3 font-normal text-gray-700">{{ $room->status }}</p>
                            <a href="{{ route('rooms.show', $room) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Show Details
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script>
        document.getElementById('downloadExcel').addEventListener('click', function() {
            var wb = XLSX.utils.book_new();
            var ws_data = [['Nama Ruang', 'Deskripsi', 'Status']];

            document.querySelectorAll('.room-card').forEach(function(card) {
                var namaRuang = card.querySelector('h5').innerText;
                var deskripsi = card.querySelectorAll('p')[0].innerText;
                var status = card.querySelectorAll('p')[1].innerText;

                ws_data.push([namaRuang, deskripsi, status]);
            });

            var ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, 'Rooms');
            XLSX.writeFile(wb, 'rooms.xlsx');
        });

        document.getElementById('downloadPDF').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            var doc = new jsPDF();
            doc.text('Daftar Ruangan', 14, 16);
            var rows = [];

            document.querySelectorAll('.room-card').forEach(function(card) {
                var namaRuang = card.querySelector('h5').innerText;
                var deskripsi = card.querySelectorAll('p')[0].innerText;
                var status = card.querySelectorAll('p')[1].innerText;

                rows.push([namaRuang, deskripsi, status]);
            });

            doc.autoTable({
                head: [['Nama Ruang', 'Deskripsi', 'Status']],
                body: rows,
                startY: 20,
            });

            doc.save('rooms.pdf');
        });
    </script>
</x-app-layout>
