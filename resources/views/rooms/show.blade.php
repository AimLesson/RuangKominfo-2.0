<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white">
                <img src='{{ asset('storage/' . $room->image) }}' alt="{{ $room->nama_ruang }}" class="mt-4 rounded-lg">
                <h1 class="mt-2 text-3xl font-semibold text-gray-600">{{ $room->nama_ruang }}</h1>
                <p class="mt-2 text-sm text-gray-600">{{ $room->deskripsi }}</p>
                <p class="mt-2 text-sm text-gray-600">{{ $room->status }}</p>
                
                <a href="{{ route('booking.create', ['room_id' => $room->id]) }}" class="mt-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 :bg-blue-600">
                    Book Now
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>

                @if (Auth::user()->role == 'admin')
                <a href="{{ route('rooms.edit', $room->id) }}" class="mt-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                    Edit
                </a>

                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="mt-4 inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 :bg-red-600">
                        Delete
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
