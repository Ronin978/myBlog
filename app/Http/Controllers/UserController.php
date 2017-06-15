<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('checkSuperAdmin', ['except' => ['index','myedit', 'update']]);
    }


    public function index()
    {
        $user=\Auth::user();

        return view('user.index',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
            
        return view('user.myedit',['user'=>$user]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();

        return back()->with('message', 'Користувача видалено.');
    }

    public function restore($id)
    {
        $user=User::withTrashed()->find($id);
        $user->restore();

        return back()->with('message', 'Користувача відновлено.');
    }

    public function delete($id)
    {
        $user=User::withTrashed()->find($id);
        $user->forceDelete();

        return back()->with('message', 'Користувача видалено повністю.');
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        
        if($request->hasFile('preview')) 
        {
            $group=$user->group; 
            $root=$_SERVER['DOCUMENT_ROOT']."/logo/"; 
                if(!file_exists($root.$group))    {mkdir($root.$group);}
            $f_name=$request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($root.$group,$f_name); 
            $all=$request->all(); 
            $all['preview']="/logo/".$group."/".$f_name;
            $user->update($all);
        }
        else
        {
           $user->update($request->all());
        }
        
        
        return back()->with('message', 'Дані змінено');
    }
    
    public function myedit()
    {
        $user=\Auth::user();
        return view('user.myedit',['user'=>$user]);
    }

    public function myshow()
    {
        $users=User::withTrashed()->orderBy('created_at', 'DESC')->paginate(20);
        return view('user.allUsers',['users'=>$users]);
    }

}