<?php
namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $user = User::where('email',$request->email)->first();
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect(route("home"));
        }

    }

}
