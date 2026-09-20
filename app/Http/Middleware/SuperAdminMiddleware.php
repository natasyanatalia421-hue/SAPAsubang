<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Pastikan user adalah super admin.
     * Penggunaan di route: middleware('super_admin')
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isSuperAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses ditolak. Hanya super admin yang diizinkan.'], 403);
            }

            abort(403, 'Hanya super admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}