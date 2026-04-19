<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $settingsPath = storage_path('app/settings.json');

        if (File::exists($settingsPath)) {
            $settings = json_decode(File::get($settingsPath), true);

            if (!empty($settings['maintenance_mode'])) {
                // Allow admin users to bypass everything
                if (auth()->check() && auth()->user()->isAdmin()) {
                    return $next($request);
                }

                // Allow these paths so admin can log in and users can contact
                $allowedPaths = [
                    'login',
                    'logout',
                    'contact',
                    'admin/*',
                    '_ignition/*',
                    'sanctum/*',
                ];

                foreach ($allowedPaths as $pattern) {
                    if ($request->is($pattern)) {
                        return $next($request);
                    }
                }

                return response()->view('frontend.maintenance', [
                    'settings' => $settings,
                ], 503);
            }
        }

        return $next($request);
    }
}
