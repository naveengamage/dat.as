<?php

class Category extends Eloquent {
	protected $guarded = array();
	
	protected $table = 'sub_cat';
	
	public static $rules = array(
		'name' => 'required',
		'order' => 'required'
	);

}
