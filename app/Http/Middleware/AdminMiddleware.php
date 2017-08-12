<?php

namespace App\Http\Middleware;

use Closure;

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

        if(!auth()->check()) // Si el usuario no ha iniciado sesión, se redirecciona al login
            return redirect('login');


        if(auth()->user()->role_id != 1) // Si el usuario loggeado no es Administrador (role 1), se redirecciona al dashboard
            return redirect('dashboard');

        return $next($request);
    }
}
