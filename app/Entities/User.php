<?php namespace TeachMe\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

	public function voted()
	{
		return $this->belongsToMany(Ticket::class, 'votes')->withTimestamps();
	}
	
	public function hasVoted(Ticket $ticket)
	{
		return $this->voted()->where('ticket_id', $ticket->id)->count();
	}
	
	public function vote(Ticket $ticket)
	{
		if ($this->hasVoted($ticket)) {
			return false;
		}

		$this->voted()->attach($ticket);
		return true;
	}

	public function unvote(Ticket $ticket)
	{
		if (! $this->hasVoted($ticket)) {
			return false;
		}
		
		$this->voted()->detach($ticket);
		return true;
	}

	public function isAuthor(Ticket $ticket)
	{
		return $this->id == $ticket->user_id;
	}

	public function isAdmin()
	{
		return $this->role == 'admin';
	}
}
