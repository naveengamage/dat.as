<?php

class UserAchievements extends Eloquent {

	protected $table = 'user_arch';
	
	protected $guarded = array();
	
	public function full()
    {
        return $this->hasMany('Achievements');
    }

}
