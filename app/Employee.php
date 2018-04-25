<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function superviser()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subordinates()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
