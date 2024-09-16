<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil informasi URL dan IP
        $url = $request->fullUrl();
        $ip = $request->ip();
        
        // Ambil data user jika sudah login
        $user = Auth::check() ? Auth::user()->name : 'Guest';
        
        // Ambil data input dari form kecuali field sensitif
        $inputData = $request->except(['password', 'password_confirmation']);

        // Siapkan data log
        $logData = [
            'date' => Carbon::now()->toDateTimeString(),
            'user' => $user,
            'ip' => $ip,
            'url' => $url,
            'input' => $inputData,
        ];

        // Tentukan format log message
        $logMessage = sprintf(
            "[%s] %s accessed %s from IP %s with data: %s", 
            $logData['date'], 
            $logData['user'], 
            $logData['url'], 
            $logData['ip'],
            json_encode($logData['input']) // Convert input data to JSON format
        );

        // Buat log terpisah berdasarkan hari
        $logFile = storage_path('logs/visitors-' . Carbon::now()->format('Y-m-d') . '.log');

        // Tulis log ke file
        Log::build([
            'driver' => 'single',
            'path' => $logFile,
        ])->info($logMessage);

        return $next($request);
    }
}
