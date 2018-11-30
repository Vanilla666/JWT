<?php

namespace App\Repositories;

use App\Entities\Post;

class PostRepository //做資料庫查詢
{
    public function index() //查詢文章與使用者資訊
    {
        return Post::with('user')->get(); //Post與User關聯 Post的user_id 為user的外來鑑
    }

    public function find($id) //找到第ID筆文章
    {
        return Post::find($id);
    }
    public function create(array $data) //創建文章並存進資料庫
    {
        return auth()->user()->posts()->create($data);
    }
    public function update($id, array $params) //更新該篇文章
    {
        $post = Post::find($id);
        return $post ?$post->update($params) : false; // 三元式 ? true : false 做
    }
    public function delete($id) //刪除第ID筆文章
    {
        return Post::destroy($id);
    }
}
