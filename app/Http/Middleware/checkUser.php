<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Task;

use Closure;

class CheckUser
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
        if (Auth::check()) {
            //認証中のユーザーIDと異なる場合、ログアウト
            $route_id = $request->route()->parameter('task');
            if($route_id){
                if(Task::find($route_id)->user_id !== Auth::id()){
                    return redirect()->route('logout.get');
                }
            }
        }

        return $next($request);
    }
}
