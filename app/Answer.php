<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
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
    }

    public function getCreateddateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
