<?php

namespace App;

use App\Answer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model {

    use VotableTrait;
     
	protected $fillable = ['title','body'];
	protected $dates = ['created_at'];
    
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function getUrlAttribute(){
    	return route("questions.show", $this->slug);
    }
    public function getCreatedDateAttribute(){
    	return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
    	if($this->answers_count > 0){
    		if($this->best_answer_id){
    			return "answered-accepted";
    		}
    		return "answered";
    	}
    	return "unanswered";
    }

    public function getBodyHtmlAttribute(){
    	// return \Parsedown::instance()->text($this->body);
        return clean($this->bodyHtml());
    }

    public function answers(){
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');
    }

    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favourites()
    {
        return $this->belongsToMany(User::class,'favourites')->withTimestamps();// ,'question_id','user_id'); to defined particular foreign id
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id',auth()->id())->count() > 0;
    }

    public function getIsFavouritedAttribute()
    {
        return $this->isFavourited();
    }

    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }

    public function getExcerptAttribute()
    {
        return $this->excerpt(250);
    }

    public function excerpt($length)
    {
       return Str::limit(strip_tags($this->bodyHtml()), $length);
    }

    private function bodyHtml()
    {
        return \Parsedown::instance()->text($this->body);
    }
}
