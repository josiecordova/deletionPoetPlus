<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    public $text;
	public $author;
	public $authored_on;
}
