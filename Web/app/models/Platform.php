<?php

class Platform extends Eloquent
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'platforms';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	// array of attributes we CAN set
     protected $fillable = array('title');
 
     // and those we can't 
     protected $guarded = array('identifier');	
}