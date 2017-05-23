<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'word';

    protected $fillable = ['word', 'meaning'];


}
