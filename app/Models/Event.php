<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'acara',
        'id_rooms',
        'nama_rooms',
        'asalbidang',
        'date',
        'start',
        'finish',
        'peserta',
        'catatan',
        'presensi',
        'id_user',
        'rejection_note',
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'id_rooms');
    }

    public static function isRoomAvailable($roomId, $startTime, $endTime, $date)
    {
        // Fetch events that clash with the requested time in the given room
        $clashingEvents = self::where('id_rooms', $roomId)
                            ->where('date', $date)
                            ->where(function ($query) use ($startTime, $endTime) {
                                $query->whereBetween('start', [$startTime, $endTime])
                                      ->orWhereBetween('finish', [$startTime, $endTime])
                                      ->orWhere(function ($query) use ($startTime, $endTime) {
                                          $query->where('start', '<', $startTime)
                                                ->where('finish', '>', $endTime);
                                      });
                            })
                            ->get();

        // If there are clashing events, return them
        if ($clashingEvents->isNotEmpty()) {
            return $clashingEvents;
        }

        // If no clashing events, return null or false
        return null;
    }



}
