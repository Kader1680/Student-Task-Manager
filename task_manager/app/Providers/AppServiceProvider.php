<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Help;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot()
{
    View::composer('layouts.navbar', function ($view) {
        $helpsCount = 0;
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'student') {
                $helpsCount = Help::where('student_id', $user->id)->count();
            } elseif ($user->role === 'teacher') {
                $helpsCount = Help::where('teacher_id', $user->id)->count();
            }
        }
        $view->with('helpsCount', $helpsCount);
    });
}
}
