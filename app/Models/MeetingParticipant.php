<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingParticipant extends Model
{
    use HasFactory;
    protected $table = 'meeting_participants';

    protected $primaryKey = 'mep_id';
    protected $fillable = [
                            'meeting_id',
                            'user_id'
    ];

    public function meetings()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'meeting_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
