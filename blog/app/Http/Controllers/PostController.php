<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository; //使用Post資料庫查詢


class PostController extends Controller
{

    public function __construct(PostRepository $postRepo) //建構子
    {
        $this->postRepo = $postRepo; //依賴注入
        $this->middleware('auth:api')->except('login'); //中介層 走 API 
    }

    public function index() //瀏覽文章和使用者資料 get方式
    {
        $posts = $this->postRepo->index(); //查詢文章與使用者資訊
        //  dd($posts);
        return response()->json(['status' => 0, 'posts' => $posts]); //成功回傳
    }

    public function store() //存文章 post方式
    {
        // dd('asdsa');
        $data = $this->postRepo->create(request()->only('title', 'content')); //必要輸入參數 格式key:value
        return response()->json(['status' => 0, 'data' => $data]); //成功回傳
    }

    public function show() //顯示單筆文章  get 方式  
    {
        $number = request(['post_id']); //新增需要的參數 藉由該參數去找第幾篇文章
        $post = $this->postRepo->find($number); //找到第ID筆文章
        if (!$post) {
            return response()->json(['status' => 1, 'message' => 'post not found'], 404); //沒有找到第ID筆文章 回報404
        } 
        return response()->json(['status' => 0, 'post' => $post]);//成功回傳
    }

    public function update($id)//更新該篇文章  $request = http請求 $id = 第ID筆
    {
        $result = $this->postRepo->update($id, request()->only('title', 'content')); //update( array $data ) 帶過去是以array來寫
    
        if (!$result) {
           return response()->json(['status' => 1],404);  //更新失敗回傳
        }
    
        return response()->json(['status' => 0, 'message' => '更新成功']); //更新成功回傳 key:value 
    }

    public function destroy($id) //刪除文章
    {
        // $number = request(['post_id']); //新增需要的參數 藉由該參數去找第幾篇文章
        // dd('asdasd');
        $result = $this->postRepo->delete($id); //刪除第ID筆文章
        if (!$result) { //如果沒有第ID筆文章
            return response()->json(['status' => 1, 'message' => 'post not found'], 404); //回報404錯誤
        }

        return response()->json(['status' => 0, 'message' => 'success']); //成功刪除 回傳
    }
    public function query($title)
    {
        // $title = request(['title']); //找到收尋title的參數 返回陣列型態需要字串型態 $title['title'] 拿到字串
        // dd($title);
        $find_title = $this->postRepo->query($title); //查詢文章藉由tltle 
        return response()->json(['status' => 0, 'find_title' => $find_title]); //成功刪除 回傳
    }
}
