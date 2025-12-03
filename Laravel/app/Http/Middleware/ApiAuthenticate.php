<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
class ApiAuthenticate  extends Middleware
{
      protected function redirectTo($request)
    {
        return null;
    }
   
}
