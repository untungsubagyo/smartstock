<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_station_id',
        'direction',
        'started_at',
        'finished_at',
        'total_records',
        'success_count',
        'failed_count',
        'status',
        'message',
    ];

    public function posStation()
    {
        return $this->belongsTo(PosStation::class);
    }
}

