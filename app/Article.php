<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;


    protected $table="articles"; //нзвание таблицы в базе
    protected $fillable=['title','content','preview','category_id'];
    protected $dates = ['deleted_at'];

    public function comments()
	{
	return $this->hasMany('App\Comments','article_id','title');
	}
}
