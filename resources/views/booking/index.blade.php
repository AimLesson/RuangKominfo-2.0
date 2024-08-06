<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex mb-2">
                @if (Auth::user()->role == 'admin')
                <button id="downloadExcel" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                    Download Excel
                </button>
                <button id="downloadPDF" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                    Download PDF
                </button>
                @endif
            </div>
            @foreach ($bookings as $room => $roomBookings)
                <div class="p-4 relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
                    <h3 class="uppercase text-lg font-semibold text-gray-800 mb-4">{{ $room }}</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-acara">
                                    Acara
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    QR Code Presensi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Peserta
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Ruang
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Penanggung Jawab
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Mulai
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Selesai
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Durasi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Status Kegiatan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Status Pelaksanaan
                                </th>
                                @if (Auth::user()->role == 'admin')
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                    Action
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($roomBookings->sortBy('date') as $booking)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900  max-w-acara">
                                        {{ $booking->acara }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div id="qrcode-{{ $booking->id }}"></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->peserta }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->nama_rooms }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->nama }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->asalbidang }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->start }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->finish }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 ">
                                        {{ $booking->duration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        @if (Auth::user()->role == 'admin')
                                            <select class="status-select" data-id="{{ $booking->id }}">
                                                <option value="Menunggu Persetujuan" {{ $booking->status == 'Menunggu Persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                                <option value="Disetujui" {{ $booking->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                <option value="Tidak Disetujui" {{ $booking->status == 'Tidak Disetujui' ? 'selected' : '' }}>Tidak Disetujui</option>
                                            </select>
                                        @elseif (Auth::user()->role == 'user')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($booking->status == 'Menunggu Persetujuan')
                                                    bg-yellow-100 text-yellow-800
                                                @elseif ($booking->status == 'Disetujui')
                                                    bg-green-100 text-green-800
                                                @elseif ($booking->status == 'Tidak Disetujui')
                                                    bg-red-100 text-red-800
                                                @endif
                                            ">
                                                {{ $booking->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($booking->date . ' ' . $booking->start), \Carbon\Carbon::parse($booking->date . ' ' . $booking->finish)))
                                                bg-blue-100 text-blue-800">Mulai
                                            @elseif (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($booking->date . ' ' . $booking->finish)))
                                                bg-green-100 text-green-800">Selesai
                                            @else
                                                bg-yellow-100 text-yellow-800">Belum Dimulai
                                            @endif
                                        </span>
                                    </td>
                                    @if (Auth::user()->role == 'admin')
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex">
                                            {{-- <a href="{{ route('booking.edit', $booking) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                            <form action="{{ route('booking.destroyadmin', $booking) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Ensure these scripts are loaded before your custom script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif

            $('.status-select').on('change', function() {
                var bookingId = $(this).data('id');
                var newStatus = $(this).val();

                $.ajax({
                    url: '/booking/' + bookingId + '/update-status',
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        toastr.success('Status updated successfully.');
                    },
                    error: function(xhr) {
                        toastr.error('Failed to update status.');
                    }
                });
            });

            $('#downloadExcel').on('click', function() {
                var bookings = @json($bookings);
                var wb = XLSX.utils.book_new();

                for (var room in bookings) {
                    if (bookings.hasOwnProperty(room)) {
                        var ws_data = [['Acara', 'Jumlah Peserta', 'Ruang', 'Penanggung Jawab', 'Pengguna', 'Tanggal', 'Mulai', 'Selesai', 'Durasi']];

                        bookings[room].forEach(function(booking) {
                            ws_data.push([
                                booking.acara,
                                booking.peserta,
                                booking.nama_rooms,
                                booking.nama,
                                booking.asalbidang,
                                new Date(booking.date).toLocaleDateString('en-GB'),
                                booking.start,
                                booking.finish,
                                booking.duration
                            ]);
                        });

                        var ws = XLSX.utils.aoa_to_sheet(ws_data);
                        XLSX.utils.book_append_sheet(wb, ws, room);
                    }
                }

                XLSX.writeFile(wb, 'bookings.xlsx');
            });

            document.getElementById('downloadPDF').addEventListener('click', function() {
                const { jsPDF } = window.jspdf;

                var doc = new jsPDF();

                var margin = { top: 20, right: 20, bottom: 20, left: 20 };
                var pageWidth = doc.internal.pageSize.width - margin.left - margin.right;
                var pageHeight = doc.internal.pageSize.height - margin.top - margin.bottom;
                var startY = margin.top;

                doc.setFontSize(18);
                doc.text('Jadwal Kegiatan', margin.left, startY);
                startY += 10;

                var bookings = @json($bookings);

                for (var room in bookings) {
                    if (bookings.hasOwnProperty(room)) {
                        doc.setFontSize(14);
                        doc.text(room, margin.left, startY);

                        var rows = [];
                        bookings[room].forEach(function(booking) {
                            rows.push([
                                booking.acara,
                                booking.peserta,
                                booking.nama_rooms,
                                booking.nama,
                                booking.asalbidang,
                                new Date(booking.date).toLocaleDateString('en-GB'),
                                booking.start,
                                booking.finish,
                                booking.duration
                            ]);
                        });

                        doc.autoTable({
                            head: [['Acara', 'Jumlah Peserta', 'Ruang', 'Penanggung Jawab', 'Pengguna', 'Tanggal', 'Mulai', 'Selesai', 'Durasi']],
                            body: rows,
                            startY: startY + 10,
                            margin: { left: margin.left, right: margin.right },
                            tableWidth: pageWidth,
                            styles: { overflow: 'linebreak' },
                            headStyles: { fillColor: [220, 220, 220] },
                            columnStyles: {
                                0: { cellWidth: 'auto', maxCellWidth: 40 },
                                1: { cellWidth: 'auto' },
                                2: { cellWidth: 'auto' },
                                3: { cellWidth: 'auto' },
                                4: { cellWidth: 'auto' },
                                5: { cellWidth: 'auto' },
                                6: { cellWidth: 'auto' },
                                7: { cellWidth: 'auto' },
                                8: { cellWidth: 'auto' },
                            },
                            didDrawPage: function(data) {
                                var pageCount = doc.internal.getNumberOfPages();
                                doc.setFontSize(10);
                                doc.text('Page ' + String(data.pageNumber) + ' of ' + String(pageCount), margin.left, pageHeight + margin.top + 10);
                            }
                        });

                        startY = doc.autoTable.previous.finalY + 10;

                        if (startY > pageHeight) {
                            doc.addPage();
                            startY = margin.top;
                        }
                    }
                }

                doc.save('bookings.pdf');
            });

            // Generate QR codes with custom image
            var bookings = @json($bookings);
            for (var room in bookings) {
                if (bookings.hasOwnProperty(room)) {
                    bookings[room].forEach(function(booking) {
                        var qrcodeContainer = document.getElementById('qrcode-' + booking.id);
                        var qrCode = new QRCode(qrcodeContainer, {
                            text: booking.presensi,
                            width: 128,
                            height: 128
                        });

                        // Create a custom image element
                        var img = new Image();
                        img.src = 'logo.png'; // Replace with your image path
                        img.onload = function() {
                            var canvas = qrcodeContainer.querySelector('canvas');
                            var context = canvas.getContext('2d');
                            var size = 128;
                            var imgSize = size * 0.2; // 20% of the QR code size
                            context.drawImage(img, (size - imgSize) / 2, (size - imgSize) / 2, imgSize, imgSize);
                        };
                    });
                }
            }
        });
    </script>
</x-app-layout>
