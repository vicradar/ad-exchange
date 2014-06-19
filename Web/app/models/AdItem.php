<?php

class AdItem extends Eloquent
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'adItems';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	// array of attributes we CAN set
     protected $fillable = array('rootFileIdentifier', 'title', 'mimeType', 'storeUrl', 'appUrl');
 
     // and those we can't 
     protected $guarded = array('identifier');	
}