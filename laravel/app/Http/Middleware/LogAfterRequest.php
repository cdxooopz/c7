<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LogAfterRequest
{
    public function handle($request, \Closure  $next)
	{   
        app('db')
            ->table('transactions')
            ->insert([
                'request' => $request,
                'created_at' => Carbon::now(),
            ]);
		return $next($request);
	} 

}
