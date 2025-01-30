<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    use HasFactory;
    protected $primaryKey = 'facilities_id';
    protected $fillable = [
                            'facilities'

    ];


}
