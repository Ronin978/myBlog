<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function save(Request $request, $id)
	{
		$user=\Auth::user();
		$this->validate($request, [
			'content' => 'required|min:5|max:400'
		]);
		
		$all=$request->all();
		$all['article_id']=Article::where('id', "$id")->value('title');
		
	  if (\Auth::user()) 
	  {
		$all['author']=$user->name;		
		$all['email']=$user->email;
		$all['preview']=$user->preview;
	  }
	  else
	  {
	  	$all['author']='Гость: '.$all['author'];
	  	if (!$all['email']) {
	  		$all['email']='none';
	  	}
	  	$all['preview']='/logo/guess-who.jpg';
	  }
		Comments::create($all);
		return back()->with('message', 'Коментар успішно доданий.'); 
	}

	public function index()
	{
		$comment=Comments::withTrashed()->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.comments.allComments',['comments'=>$comment]);
	}

	public function edit($id)
	{
		$comments=Comments::find($id);
		return view('admin.comments.edit',['comment'=>$comments]);
	}

	public function update(Request $request, $id)
	{
		$comment=Comments::find($id);
		$comment->update($request->all());
        
        return back()->with('message', 'Коментар змінений.');
	}

	public function restore($id)
    {
        $comment=Comments::withTrashed()->find($id);
        $comment->restore();

        return back()->with('message', 'Комент відновлено.');     
    }

    public function destroy($id)
    {
        $comment=Comments::find($id);
        $comment->delete();

        return back()->with('message', 'Комент видалено.');
    }

    public function delete($id)
    {
        $comment=Comments::withTrashed()->find($id);
        $comment->forceDelete();

        return back()->with('message', 'Комент видалено.');     
    }

}
