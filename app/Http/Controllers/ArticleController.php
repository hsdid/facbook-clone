<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\Article;
use DB;
use Image;


class ArticleController extends Controller
{
    
    //add new articles
    public function add_article(Request $request){

        
        
        $user_id = $request->user_id;
        $body = $request->body;
        
        $file = $request->image;
        
        if(empty($file)){
            
            $article = new Article; 
            $article->user_id = $user_id;
            $article->body = $body;
            $article->image = 'default.jpg';
            $article->save();

            return response()->json([
               
                'msg' => 'post are created',
                
    
            ]);

        } else {

            $filename = time() . '.' .$file->getClientOriginalExtension(); 
       
            Image::make($file)->resize(300,300)->save(public_path('/uploads/article_img/'.$filename) );
            
            
            $article = new Article; 
            $article->user_id = $user_id;
            $article->body = $body;
            $article->image = $filename;
            $article->save();
    
           
    
            return response()->json([
               
                'msg' => 'post are created',
                
    
            ]);


            
        }
        
       
        
    }

    // select all articles
    public function all_articles (){


       // $articles = Article::orderBy('created_at', 'desc')->get();
        $articles = DB::select("SELECT a.id ,a.user_id ,a.body,a.created_at,a.image, u.name 
                                FROM articles AS a 
                                LEFT JOIN users AS u
                                ON a.user_id = u.id
                                ORDER BY a.created_at DESC");



        return response()->json([
           
            'articles' => $articles

        ]);

    }

    //select all articles for user id
    public function user_articles($id){

        //$articles = Article::where('user_id',$id)->orderBy('created_at', 'desc')->get();
        //$articles = DB::select("SELECT * FROM articles WHERE user_id = '$id'  ORDER BY created_at DESC");
        
        $articles = DB::select("SELECT a.id ,a.user_id ,a.body,a.created_at,a.image, u.name 
        FROM articles AS a 
        INNER JOIN users AS u
        ON a.user_id = u.id WHERE a.user_id ='$id'
        ORDER BY a.created_at DESC");

        return response()->json([
           
            'articles' => $articles

        ]);
    }

    
    
    public function destroy(Request $request)
    {   

        $id = $request->id;
        //delete from article_user table
        if(Article::where('id',"$id")->delete())
        {
          
            return response()->json([
           
                'msg' => 'post deleted'
    
            ]);
            
        }
    }


}
