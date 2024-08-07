<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Event;
use App\Models\eventbackup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        $currentDateTime = Carbon::now();

        // Filter bookings to include only future events
        $bookings = Event::where(function ($query) use ($currentDateTime) {
            $query->where('date', '>', $currentDateTime->toDateString())
                ->orWhere(function ($query) use ($currentDateTime) {
                    $query->where('date', '=', $currentDateTime->toDateString())
                        ->where('finish', '>', $currentDateTime->toTimeString());
                });
        })->get()->groupBy('nama_rooms');

        foreach ($bookings as $room => $roomBookings) {
            foreach ($roomBookings as $booking) {
                $start = Carbon::parse($booking->start);
                $finish = Carbon::parse($booking->finish);
                $duration = $start->diff($finish)->format('%H:%I');
                $booking->duration = $duration;
            }
        }

        return view('booking.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Event $booking)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Tidak Disetujui',
        ]);

        $booking->status = $request->status;
        $booking->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }


    public function create()
    {
        $rooms = Room::all();
        return view('booking.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'acara' => 'required|string|max:255',
            'peserta' => 'required|string|max:255',
            'id_rooms' => 'required|exists:rooms,id',
            'nama_rooms' => 'required|string|max:255',
            'asalbidang' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|',
            'finish' => 'required||after:start',
            'presensi' => 'required|string',

        ], [
            'start.required' => 'Kolom mulai wajib diisi.',
            'start.date_format' => 'Format kolom waktu tidak sesuai.',
            'finish.required' => 'Kolom selesai wajib diisi.',
            'finish.date_format' => 'Format kolom waktu tidak sesuai.',
            'finish.after' => 'Waktu selesai harus setelah waktu mulai.',
            'nama.required' => 'Kolom nama wajib diisi.',
            'acara.required' => 'Kolom acara wajib diisi.',
            'id_rooms.required' => 'Kolom ID ruangan wajib diisi.',
            'id_rooms.exists' => 'Ruangan yang dipilih tidak valid.',
            'nama_rooms.required' => 'Kolom nama ruangan wajib diisi.',
            'asalbidang.required' => 'Kolom asal bidang wajib diisi.',
            'asalbidang.in' => 'Asal bidang tidak valid.',
            'date.required' => 'Kolom tanggal wajib diisi.',
            'date.date' => 'Format kolom tanggal tidak valid.',
        ]);

        if (!Event::isRoomAvailable($request->id_rooms, $request->start, $request->finish, $request->date)) {
            return back()->withErrors(['msg' => 'Ruangan tidak tersedia di jadwal yang ditentukan']);
        }

        // Merge user data into the request
        $request->merge([
            'nama' => Auth::user()->name,
            'id_user' => Auth::user()->id,
        ]);

        Event::create($request->all());
        eventbackup::create($request->all());

        return redirect()->route('history')->with('success', 'Ruang berhasil dibooking');
    }

    public function edit(Event $booking)
    {
        $rooms = Room::all();
        return view('booking.edit', compact('booking', 'rooms'));
    }

    public function update(Request $request, Event $booking)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'acara' => 'required|string|max:255',
            'peserta' => 'required|string|max:255',
            'id_rooms' => 'required|exists:rooms,id',
            'nama_rooms' => 'required|string|max:255',
            'asalbidang' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|',
            'finish' => 'required||after:start',
            'presensi' => 'required|string',

        ], [
            'start.required' => 'Kolom mulai wajib diisi.',
            'start.date_format' => 'Format kolom waktu tidak sesuai.',
            'finish.required' => 'Kolom selesai wajib diisi.',
            'finish.date_format' => 'Format kolom waktu tidak sesuai.',
            'finish.after' => 'Waktu selesai harus setelah waktu mulai.',
            'nama.required' => 'Kolom nama wajib diisi.',
            'acara.required' => 'Kolom acara wajib diisi.',
            'id_rooms.required' => 'Kolom ID ruangan wajib diisi.',
            'id_rooms.exists' => 'Ruangan yang dipilih tidak valid.',
            'nama_rooms.required' => 'Kolom nama ruangan wajib diisi.',
            'asalbidang.required' => 'Kolom asal bidang wajib diisi.',
            'asalbidang.in' => 'Asal bidang tidak valid.',
            'date.required' => 'Kolom tanggal wajib diisi.',
            'date.date' => 'Format kolom tanggal tidak valid.',
        ]);

        if (!Event::isRoomAvailable($request->id_rooms, $request->start, $request->finish, $request->date, $booking->id)) {
            return back()->withErrors(['msg' => 'Ruangan tidak tersedia di jadwal yang ditentukan']);
        }

        $request->merge([
            'nama' => Auth::user()->name,
            'id_user' => Auth::user()->id,
        ]);

        $booking->update($request->all());

        return redirect()->route('history')->with('success', 'Jadwal Berhasil Diperbarui');
    }


    public function destroy(Event $booking)
    {
        $booking->delete();
        return redirect()->route('dashboard')->with('success', 'Jadwal Berhasil Dibatalkan');
    }

    public function destroyadmin(Event $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Jadwal Berhasil Dihapus');
    }

    public function indexroom()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function createroom()
    {
        $rooms = Room::all();
        return view('rooms.create', compact('rooms'));
    }

    public function storeroom(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nama_ruang' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        // Create a new room record
        Room::create($validated);

        // Redirect to a specific route with a success message
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function editroom($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function updateroom(Request $request, $id)
    {
        // Log the start of the update process
        Log::info("Updating room with ID: $id");

        try {
            // Validate the request data
            $request->validate([
                'nama_ruang' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'deskripsi' => 'required|string',
            ]);

            // Find the room by ID
            $room = Room::findOrFail($id);

            // Update the room details
            $room->nama_ruang = $request->nama_ruang;
            $room->deskripsi = $request->deskripsi;
            $room->status = 'Tersedia';

            // Handle the image upload if present
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $room->image = $imagePath;
            }

            // Save the updated room
            $room->save();

            // Log success message
            Log::info("Room with ID: $id updated successfully.");

            return redirect()->route('rooms.show', $room->id)->with('success', 'Room updated successfully.');
        } catch (\Exception $e) {
            // Log the error with the exception message
            Log::error("Error updating room with ID: $id", ['error' => $e->getMessage()]);

            // Optionally, return an error response to the user
            return redirect()->route('rooms.index')->with('error', 'An error occurred while updating the room.');
        }
    }


    public function destroyRoom(Room $room)
    {
        // Handle image deletion if necessary
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        // Delete the room
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room successfully deleted.');
    }
}
