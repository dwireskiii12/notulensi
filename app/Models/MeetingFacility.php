<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingFacility extends Model
{
    use HasFactory;
    protected $table = 'meeting_facilities';

    protected $primaryKey = 'mef_id';

    protected $fillable = [
                            'meeting_id',
                            'facilities_name'
    ];

    public function meetings()
    {
        return $this->belongsTo(Meeting::class);
    }


    // public static function getMostUsedFacilities($limit = 5)
    // {
    //     return static::select('facilities_name', DB::raw('COUNT(*) as total'))
    //                  ->groupBy('facilities_name')
    //                  ->orderByDesc('total')
    //                  ->limit($limit)
    //                  ->get();
    // }

}
