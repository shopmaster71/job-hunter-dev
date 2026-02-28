<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Torann\GeoIP\Facades\GeoIP;

class SetUserLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('user_city')) {
            $location = GeoIP::getLocation($request->ip());

            // ✅ Правильный способ: прямой доступ
            $city = $location->city ?? 'Москва';
            $regionCode = $location->state ?? 'MOW';
            $regionName = $location->state_name ?? 'Москва';

            $request->session()->put([
                'user_city' => $city,
                'user_region_code' => $regionCode,
                'user_region_name' => $regionName,
            ]);
        }

        return $next($request);
    }
}
