<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$rolesAssigned)
    {
        if (!$request->user()) {
            return response()->json('Unauthorized');
        } else {
            //dd($request->user()); debugging
            //fetch all the user roles as array
            $roles = $request->user()->roles()->get();
            //dd($roles[1]->name);
            //number of roles that matches
            $match = 0;
            //array role length
            $count1 = count($roles);
            //array role-middleware assigned length
            $count2 = count($rolesAssigned);
            for ($i = 0; $i < $count1; $i++) {
                for ($j = 0; $j < $count2; $j++) {
                    if ($roles[$i]->name == $rolesAssigned[$j]) {
                        //echo $roles[$i]->name . ' and ' .$rolesAssigned[$j]; debugging
                        //checking for matches
                        $match++;
                    }
                }
                //return $next($request);
            }
            if ($match > 0) {
                //redirected to that requested request
                return $next($request);
            }
            //return json message
            return response()->json('Unauthorized');
        }

        return response()->json('Unauthorized');
    }
}
