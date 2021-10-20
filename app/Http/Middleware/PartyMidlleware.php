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
        // echo 'the Middleware is running. <br/>';
        $userRole = auth()->user()->role;
        $currentRouteName = Route::currentRouteName();
        echo 'UserRole:'. $userRole . '<br/>';
        echo 'Current Route Name: ' . $currentRouteName . '<br/>';

        if(in_array($currentRouteName, $this->userAccessRole()[$userRole])) {

        return $next($request);

        } else {

            abort(403, 'You are not allowed to access this Page');
        }

    }


    private function userAccessRole() {

        return [
            'user' => [

                'dashboard'
            ],

            'candidate' => [

                'dashboard',
                'party.index',
                'party.show',
                'candidate.index',
                'candidate.can_index',
                 'candidate.CreateCandidate',
                  'candidate.store',
                  'candidate.show',
                  'candidate.deleteRequest',
                  


            ],

            'admin' => [

                'party.index',
                'party.create',
                'party.store',
                'party.show',
                'party.edit',
                'party.update',
                'party.destroy',

                'dashboard',

                'candidate.index',
                'candidate.can_index',
                'candidate.show',
                'candidate.edit',
                'candidate.CreateCandidate',
                'candidate.update',
                'candidate.destroy',
                'candidate.searchCanId',
                'candidate.DeleteCandidateID',

                'api.index'
            ],
        ];
    }
}
