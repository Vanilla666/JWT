<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model //Post model 做關聯user 
{
    protected $fillable = [ // 批量復值
        'user_id', 'title', 'content',
    ];
    
    public function user() //關聯user 一個文章一個使用者
    {
        return $this->belongsTo('App\User'); 
    }
}
