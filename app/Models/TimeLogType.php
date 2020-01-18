<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLogType extends Model
{
    public function scopeActive()
    {
        return $this->where('is_active', 1);
    }
}
