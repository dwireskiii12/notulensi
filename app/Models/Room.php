<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'room_id';
    protected $fillable = [
                            'room_name',
                            'capacity'
    ];

    public function meetings()
    {

        return $this->hasMany(Meeting::class, 'room_id', 'room_id');
    }

}
