<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class ArticlesController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::withTrashed()->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.article.allArticles',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all(); 
        return view('admin.article.create',['categories'=>$category]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('preview')) 
        {
            $date=date('d.m.Y');
            $root=$_SERVER['DOCUMENT_ROOT']."/images/";
            if(!file_exists($root.$date))     
                {
                    mkdir($root.$date);
                } 
            $f_name=$request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($root.$date,$f_name); 
            $all=$request->all(); 
            $all['preview']="/images/".$date."/".$f_name;
            Article::create($all);
        }
        else
        {
            Article::create($request->all());
        }
        return back()->with('message', "Article успішно додано");   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles=Article::withTrashed()->find($id);
        return view('admin.article.show',['article'=>$articles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles=Article::withTrashed()->find($id);
        $category=Category::all();
        
        return view('admin.article.edit',['article'=>$articles,'categories'=>$category]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article=Article::withTrashed()->find($id);
        
        if($request->hasFile('preview')) 
      {
            $date=date('d.m.Y'); 
            $root=$_SERVER['DOCUMENT_ROOT']."/images/"; 
                if(!file_exists($root.$date))    {mkdir($root.$date);}
            $f_name=$request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($root.$date,$f_name); 
            $all=$request->all(); 
            $all['preview']="/images/".$date."/".$f_name;
            $article->update($all);
       }
    else
       {
           $article->update($request->all());
        }
        
        
        return back()->with('message', 'Статтю змінено');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article=Article::find($id);
        $article->delete();

        return back()->with('message', 'Статтю приховано.');
    }
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $article=Article::withTrashed()->find($id);
        $article->restore();

        return back()->with('message', 'Статтю відновлено.');
    }

    public function delete($id)
    {
        $article=Article::withTrashed()->find($id);
        $article->forceDelete();

        return back()->with('message', 'Статтю идалено повністю.');
    }
    
}
