<?php

class TvShows extends Eloquent {

	protected $table = 'tv_shows';
	
	protected $guarded = array();
	
	public static $key = 'tvrage_id';
}
