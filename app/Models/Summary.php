<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $table = 'summaries';

    protected $primaryKey = 'summary_id';
    protected $fillable = [
        'meeting_id',
        'user_id',
        'summary_result',
        'status'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'meeting_id' );
    }

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id', 'user_id');
    }
}
