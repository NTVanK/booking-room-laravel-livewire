<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Normalizer;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = ['id','category_id', 'noofroom', 'amount', 'note'];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id')->whereNotIn('status', ['payment', 'cancel','complete']);
    }

    public function getDayBefore($month, $year)
    {
        $bookings = $this->bookings;
        if ($bookings->count() > 0) {
            foreach ($bookings as $booking) {
                $day = Carbon::parse($booking->updated_at);
                if($day->month == $month && $day->year == $year)
                {
                    return Carbon::parse($booking->updated_at)->day;
                }
            }
            return null;
        }
        return null;
    }

    public function getDayAfter($month, $year)
    {
        $bookings = $this->bookings;
        if ($bookings->count() > 0) {
            foreach ($bookings as $booking) {
                $day = Carbon::parse($booking->created_at);
                if($day->month == $month && $day->year == $year)
                {
                    return Carbon::parse($booking->created_at)->day;
                }
            }
            return null;
        }
        return null;
    }

    public function checkRoom()
    {
        $bookings = $this->bookings;

        if ($bookings->count() > 0) {
            foreach ($bookings as $booking) {
                if ($booking->status == 'no confirm') {
                    return 'waite';
                }
            }
            return 'confirm';
        }

        return 'no confirm';
    }

    public function getName()
    {
        $bookings = $this->bookings;
        if ($bookings->count() > 0) {
            foreach ($bookings as $booking) {
                    $user = User::where('id', $booking->user_id)->first();
                    return $user->name;
            }
        }
        return null;
    }

    public function checkName($search)
    {
        // Normalize the search term
        $normalizedSearch = $this->normalizeString($search);

        foreach ($this->bookings as $booking) {
            $user = User::find($booking->user_id);
            if ($user) {
                // Normalize the user name
                $normalizedUserName = $this->normalizeString($user->name);
                if (stripos($normalizedUserName, $normalizedSearch) !== false) {
                    return true;
                }
            }
        }
        return false;
    }

    private function normalizeString($string)
    {
        // Convert the string to UTF-8
        $string = mb_convert_encoding($string, 'UTF-8');

        // Normalize the string to remove diacritics
        $normalized = Normalizer::normalize($string, Normalizer::FORM_D);

        // Remove any non-ASCII characters (diacritics)
        $normalized = preg_replace('/[\p{Mn}]/u', '', $normalized);

        // Convert to lowercase for case-insensitive comparison
        return mb_strtolower($normalized, 'UTF-8');
    }

}



