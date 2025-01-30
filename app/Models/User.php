<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
                            'name',
                            'email',
                            'password',
                            'role',
                            'position',
                            'phone_number',
                            'faculty',
                            'study_program',
                            'original_user_id',
                            'image'

    ];


    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'meeting_participants', 'user_id', 'meeting_id');
    }

    public function meetingParticipants()
    {
        return $this->hasMany(MeetingParticipant::class, 'user_id', 'user_id');
    }

    /**
     * Metode untuk memeriksa apakah pengguna terkait dengan rapat
     */
    public function hasRelatedMeetings()
    {
        return $this->meetingParticipants()->exists();
        return $this->meetings()->exists();
    }

    // public function meetingParticipants()
    // {
    //     return $this->hasMany(MeetingParticipant::class, 'user_id','user_id');
    // }




    // public function hasRelatedMeetings()
    // {
    //     return Meeting::where(function ($query) {
    //         $query->where('auth_id', $this->user_id)
    //             ->orWhere('meeting_minutes', $this->user_id)
    //             ->orWhere('meeting_leader', $this->user_id);
    //     })->orWhereHas('participants', function ($query) { // ubah menjadi meetingParticipants dengan huruf kecil
    //         $query->where('user_id', $this->user_id);
    //     })->exists();
    // }

    public function summaries()
    {
        return $this->hasMany(Summary::class, 'user_id', 'user_id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
