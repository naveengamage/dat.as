<?php

class Post extends Eloquent
{
  protected $table  = 'posts';
  //protected $with   = array('user');
  
  protected $fillable = array('text');

  public function user()
  {
    $this->belongsTo('User');
  }
}