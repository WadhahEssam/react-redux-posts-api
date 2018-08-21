<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function addPost ( $title , $content ) {
        app('db')->table('posts')->insert([ 'title'=>$title , 'content'=>$content ] ) ; 
        return 'done adding' ;
    }

    public function index ( $id = null ) {
        if ( $id == null ) {
            $posts = app('db')->select('select * from posts') ; 
        } else {
            $posts = app('db')->select('select * from posts where id = ? ' , [$id] ) ; 
        }
        
        return $posts ;
    }

    public function store ( Request $request ) {
        $id = app('db')->table('posts')->insertGetId( [ 'title'=>$request->title , 'content'=>$request->content ] ) ; 

        return app('db')->select('select * from posts where id = ? ' , [$id] ) ; 
    }

    public function destroy ( $id ) {
        $deletedPost = app('db')->select('select * from posts where id = ? ' , [$id] ) ; 
        app('db')->table('posts')->where('id',$id)->delete(); 
        return $deletedPost ; 
    }
    
}
