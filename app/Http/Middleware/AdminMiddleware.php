<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
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
        // Checking whether it is a User or an Admin
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return $next($request);
            } else {
                return redirect('login');
                //return redirect('404');
            }
        }
        return redirect('login');
        //return redirect('404');
    }
}
