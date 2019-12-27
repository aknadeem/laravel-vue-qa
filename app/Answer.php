<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {
    
    protected $fillable = ['title','body'];
	protected $dates = ['created_at'];
	
    public function question(){
    	return $this->belongsTo(Question::class);
    }

    public function question(){
    	return $this->belongsTo(User::class);
    }
    
    public function getBodyHtmlAttribute(){
    	return \Parsedown::instance()->text($this->body);
    }
}
