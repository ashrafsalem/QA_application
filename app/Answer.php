<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'body', 'user_id'
    ];

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // elquant events
    // events to edit columns in create or saved action
    public static function boot()
    {
        parent::boot();
        // increment answers_count in question table
        // when answer created event fired
        static::created(function($answer){
            $answer->question->increment('answers_count');
        });
        // decrement the answers count, in case of delete
        static::deleted(function ($answer){
            $answer->question->decrement('answers_count');
        });
    }

    public function getCreateddateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    private function isBest()
    {
        return $this->id == $this->question->best_answer_id;
    }
}
