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

    public function assignResource($comment)
    {
        if (is_numeric($comment)) {
            $comment = Comment::findOrFail($comment);
        }

        if ($comment->link == '' || $this->id != $comment->ticket_id) {
            abort(404);
        }

        $this->link = $comment->link;
        $this->status = 'closed';
        $this->save();

        $this->comments()->where('selected', true)->update(['selected' => false]);
        
        $comment->selected = true;
        $comment->save();
    }

    public function isOpen()
    {
        return $this->status === 'open';
    }
}
