<?php namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function voters()
    {
        return $this->belongsToMany(User::class, 'votes');
    }
    
    public function getOpenAttribute()
    {
        return $this->status == 'open';
    }

}
