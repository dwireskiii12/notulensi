<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;
    protected $table = 'meetings';
    protected $primaryKey = 'meeting_id';
    protected $fillable = [
                            'auth_id',
                            'meeting_theme',
                            'meeting_minutes',
                            'meeting_leader',
                            'description',
                            'start_time',
                            'end_time',
                            'participant_count',
                            'room_id',
                            'status'
    ];

    protected $dates = [
        'start_time',
        'end_time'
    ];
    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value); // Ubah ke objek Carbon
    }

    // Aksesors untuk end_time
    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value); // Ubah ke objek Carbon
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function participant()
    {
        return $this->hasMany(MeetingParticipant::class, 'meeting_id', 'meeting_id');

    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'meeting_participants', 'meeting_id', 'user_id');
    }

    public function facilities()
    {
        return $this->hasMany(MeetingFacility::class, 'meeting_id', 'meeting_id');
    }

    public function secretary()
    {
        return $this->belongsTo(User::class, 'auth_id');
    }

    public function minutes()
    {
        return $this->belongsTo(User::class, 'meeting_minutes');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'meeting_leader');
    }


    public function summaries()
    {
        return $this->hasMany(Summary::class, 'meeting_id', 'meeting_id');
    }
}
