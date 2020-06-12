<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    protected $fillable = [
        "day",
        "active",
        "moring_start",
        "moring_end",
        "afternoon_start",
        "afternoon_end",
        "user_id",
    ];
}
