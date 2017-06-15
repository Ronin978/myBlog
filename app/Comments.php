<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{

	use SoftDeletes;
	
    protected $table="comments";
	protected $fillable=['article_id','content','author','email','preview'];

    protected $dates = ['deleted_at'];
	
	
}


