<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Favorite;
use App\Models\Article;
use App\Models\User;
use DB;
class FavoriteController extends Controller
{
    public function index(Request $request){

        $user_id = $request->current_id;

        $articles_id = Favorite::where('user_id',$user_id)->get();
        //$articles = Article::
        $ids = array();

        foreach ($articles_id as $obj){
           array_push($ids,$obj->article_id);
        }

        //$articles = Article::findMany($ids);

        function createInClause($arr)
        {
            return '\'' . implode( '\', \'', $arr ) . '\'';
        }

        $ids = createInClause($ids);

        $articles = DB::select("SELECT a.id ,a.user_id ,a.body,a.created_at,a.image, u.name 
        FROM articles AS a 
        INNER JOIN users AS u
        ON a.user_id = u.id WHERE a.id IN ($ids)
        ORDER BY a.created_at DESC");



        return response()->json([
           
            'articles' => $articles,
            
            'articles_id' => $ids

        ]);
    }

    public function add_to_favorite(Request $request){

        $user_id = $request->user_id;
        $article_id = $request->article_id;

        $article = new Favorite;
        $article->user_id = $user_id;
        $article->article_id = $article_id;
        $article->timestamps = false ;
        $article->save();

        return response()->json([
           
            'msg' => 'article saved'
            
        ]);
    }
}


