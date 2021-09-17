<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PartyMidlleware
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
        echo 'the Midlleware is running. <br/>';
        $userRole = auth()->user()->role;
        $currebtRouteName = Route::currentRouteName();
        echo 'UserRole:'. $userRole . '<br/>';
        echo 'Current Route Name: ' . $currebtRouteName . '<br/>';
        
        if(in_array($currebtRouteName, $this->userAccessRole()[$userRole])) {

        return $next($request);

        } else {

            abort(403, 'You are not allowed');
        }

    }

    
    private function userAccessRole() {

        return [
            'user' => [

                'dashboard'
            ],

            'admin' => [

                'party',
                'party.create',
                'party.store',
                'party.show',
                'party.edit',
                'party.update',
                'party.destroy'
            ],
        ]; 
    }
}
