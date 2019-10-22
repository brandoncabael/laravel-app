<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'title', 'description', 'completed',
    ];

    /**
     * Get the user than owns the todo.
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
