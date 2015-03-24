<?php namespace App;

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
	protected $fillable = ['name', 'email', 'password', 'username'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	static function boot()
	{
		parent::boot();
		static::observe(new UserObserver);
	}

	// --------------------------------- RELATIONSHIP -------------------------------
	function fave_tour()
	{
		return $this->belongsToMany('Tour', null, 'faved_by_ids', 'fave_tour_ids');
	}

	function fave_vendor()
	{
		return $this->belongsToMany('Vendor', null, 'faved_by_ids', 'fave_vendor_ids');
	}

	function fave_destination()
	{
		return $this->belongsToMany('Destination', null, 'faved_by_ids', 'fave_destination_ids');
	}

	function orders()
	{
		return $this->hasMany('Order');
	}

	// --------------------------------- SCOPE -------------------------------
	function scopeName($q, $v)
	{
		return ($v ? $q : $q->where('name', 'like', str_replace('%', '*', $v)));
	}

	function scopeEmail($q, $v)
	{
		return ($v ? $q : $q->where('email', 'like', str_replace('%', '*', $v)));
	}

	function scopeUsername($q, $v)
	{
		return ($v ? $q : $q->where('username', 'like', str_replace('%', '*', $v)));
	}

	function scopeRole($q, $v)
	{
		return ($v ? $q : $q->where('role', 'like', str_replace('%', '*', $v)));
	}

	// --------------------------------- MUTATOR -------------------------------
	function setRoleAttribute($v)
	{
		$this->attributes['role'] = strtolower($v);
	}

	// --------------------------------- ACCESSOR -------------------------------
	function getIsTeamAttribute()
	{
		return true;
	}
	// --------------------------------- FUNCTION -------------------------------

}
