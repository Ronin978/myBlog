<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comments;
use App\Category;

class FrontController extends Controller
{
  	public function index()
	{
		$cat=Category::orderBy('title')->pluck('title');
		$articles=Article::orderBy('created_at', 'DESC')->paginate(5);
		return view('site.index',['articles'=>$articles,'categories'=>$cat]);
		
		
	}

	public function sort($filter)
    {
        $cat=Category::orderBy('title')->pluck('title');

        switch ($filter) 
        {
        	case 'date':
        		$articles=Article::orderBy('created_at', 'DESC')->paginate(5);
        		break;
        	case 'abc':
        		$articles=Article::orderBy('title')->paginate(5);
        		break;
        	case 'dateDESC':
        		$articles=Article::orderBy('created_at')->paginate(5);
        		break;
        	case 'abcDESC':
        		$articles=Article::orderBy('title', 'DESC')->paginate(5);
        		break;
        	case 'notCategory':
        		$articles=Article::where('category_id', '')->paginate(5);
        		break;
        	default:
        		$articles=Article::where('category_id', $filter)->paginate(5);
        		break;
        }

        return view('site.index',['articles'=>$articles,'categories'=>$cat]);
        
    }

	public function show($id)
	{
		if (!Article::find($id-1))
		{
			for ($i=1; $i < count(Article::withTrashed()->get()); $i++) 
			{ 
				if (Article::find($id-$i))
				{					
					$back=$i;
					break;
				}
				else
				{
					$back=0;
				} 						
			}			
		}
		else {$back=1;}


		if (!Article::find($id+1))
		{
			for ($i=1; $i < count(Article::withTrashed()->get()); $i++) 
			{ 
				if (Article::find($id+$i))
				{					
					$next=$i;
					break;
				}
				else
				{
					$next=0;
				} 						
			}			
		}
		else {$next=1;}

		$comments=Article::withTrashed()->find($id)->comments;
		$article=Article::withTrashed()->find($id);
			
		return view('site.show',['article'=>$article,'comments'=>$comments,'next'=>$next,'back'=>$back]);
		
	}
	
	
	
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
