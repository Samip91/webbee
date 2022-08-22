<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * hasMany relation with workshops
     *
     * @return void
     */
    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }
}
