<?php namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $fillable = ['title', 'status', 'link'];

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
        return $this->belongsToMany(User::class, 'votes')->withTimestamps();
    }
    
    public function getOpenAttribute()
    {
        return $this->status == 'open';
    }

}
