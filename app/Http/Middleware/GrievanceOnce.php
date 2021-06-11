<?php

namespace App\Http\Middleware;

use App\Model\Degrees;
use Closure;

class GrievanceOnce
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
        $degree=Degrees::find(request('id'));
        if ($degree->grievance == 1) {
            return redirect()->back()->with(['error'=>'you are not allowed to ues this link']);
        }

        return $next($request);
    }
}
