<?php

class AdItemPlatformMap extends Eloquent
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'adItemPlatformMaps';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	// array of attributes we CAN set
     protected $fillable = array('adItemIdentifier', 'fileHash', 'storagePath', 'usePath');
 
     // and those we can't 
     protected $guarded = array('identifier';	
}