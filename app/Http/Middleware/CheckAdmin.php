<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (\Auth::user()) 
      {        
        $group=\Auth::user()->group;
        if ($group=='admin' || $group=='superAdmin') 
        {
            return $next($request);
        } 
        else
        return back()->with('message', "Ви не маєте на це прав.");
      } 
    else
    return redirect('/login')->with('message', "Для початку зайдіть під своїм логіном");
    }
}
