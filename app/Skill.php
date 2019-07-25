<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }
}
