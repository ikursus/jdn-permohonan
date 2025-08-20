<?php

namespace App\Services;

use App\Models\Permohonan;
use Illuminate\Support\Facades\DB;

class PermohonanService
{
    public static function create()
    {
        $jokes = [
            "Why do programmers prefer dark mode? Because light attracts bugs!",
            "Why did the programmer quit his job? Because he didn't get arrays!",
            "What's a programmer's favorite hangout place? Foo Bar!",
            "Why do programmers always mix up Halloween and Christmas? Because Oct 31 equals Dec 25!",
            "Why do Java developers wear glasses? Because they don't C#!"
        ];
        
        $randomJoke = $jokes[array_rand($jokes)];
        info('Random joke: ' . $randomJoke);
        
        return $randomJoke;
    }
}
