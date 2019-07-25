<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function jobpost()
    {
        return $this->belongsTo('App\Jobpost','jobpost_id');
    }
}
