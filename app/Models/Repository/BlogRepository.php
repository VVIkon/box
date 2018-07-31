<?php
/**
 * Created by PhpStorm.
 * User: vvikon
 * Date: 29.06.18
 * Time: 18:22
 */

namespace App\Models\Repository;

use App\Models\Blog;
use App\Models\BlogChat;
use App\User;
use App\Helpers\ArrayHelper;


class BlogRepository
{
    public static function loadBlogs()
    {
        $blog = Blog::with('blogChat')->orderBy('id', 'DESC')->get()->toArray();
        if (count($blog)==0){
            $blog[] = [
                'blog_header' => '',
                'blog_img' => '',
                'bolg_content' => '',
                'blog_hashtags' => ''
            ];
            return $blog;
        }
        return $blog;
    }



    public static function getBlogById($id)
    {
        $blog = Blog::with('blogChat')->where('id', '=', $id)->first()->toArray();
        return $blog;
    }

    /**
     * @param array $params = [
     *      id => null, (insert mode)
     *      blog_header => '',
     *      blog_img => '',
     *      blog_content => '',
     *      blog_hashtags => ''
     * ]
     * @return array
     */
    public static function saveBlog(array $params)
    {
        if(isset($params['id'])){
            $model = Blog::where('id','=',$params['id'])->first();
        }else(
            $model = new Blog()
        );
        $model->blog_header = $params['blog_header'];
        $model->blog_img = $params['blog_img'];
        $model->bolg_content =  $params['bolg_content'];
        $model->blog_hashtags =  $params['blog_hashtags'];
        $res =  $model->save();
        return ['result'=>$res];
    }

    public static function deleteBlog($id)
    {
        $model = Blog::where('id','=',$id)->first();
        $res =  $model->delete();
        return ['result'=>$res];
    }


    public static function loadChat($blogId)
    {
        $chat = BlogChat::with('user')->where('blog_id','=',$blogId)->orderBy('id', 'ASC')->get()->toArray();
        if (count($chat)==0){
            $chat[] = [
                'id' => null,
                'parent_id' => null,
                'blog_id' => null,
                'user_id' => null,
                'chat_comment' => null,
                'created_at' => null,
                "user"=>[
                    "id"=>null,
                    "name"=>null,
                    "email"=>null,
                    "imgPath"=>null,
                ]
            ];
            return $chat;
        }
        $sortChat = ArrayHelper::hierarchicalSort($chat);
        return $sortChat;
    }

    /**
     * @param array $params = [
     *      id => null, (insert mode)
     *      parent_id => '',
     *      blog_id => '',
     *      user_id => '',
     *      chat_comment => ''
     * ]
     * @return array
     */
    public static function saveBlogChat(array $params)
    {
        if(isset($params['id'])){
            $model = BlogChat::where('id','=',$params['id'])->first();
        }else(
            $model = new BlogChat()
        );
        $model->parent_id = $params['parent_id'];
        $model->blog_id = $params['blog_id'];
        $model->user_id =  $params['user_id'];
        $model->chat_comment =  $params['chat_comment'];
        $res =  $model->save();
        return ['result'=>$res];
    }

    /**
     * @param $id
     * @return array
     */
    public static function deleteBlogChat($id)
    {
        $model = BlogChat::where('id','=',$id)->first();
        $res =  $model->delete();
        return ['result'=>$res];
    }
}