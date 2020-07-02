<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    protected $fillable = [
        'description',
        'specialty_id',
        'doctor_id',
        'patient_id',
        'scheduled_date',
        'scheduled_time',
        'type',
        'status'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(User::class);
    }

    public function getScheduledTime12Attribute()
    {
        return (new Carbon($this->scheduled_time))->format('g:i A');
    }
}
