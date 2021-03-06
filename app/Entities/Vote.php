<?php namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
