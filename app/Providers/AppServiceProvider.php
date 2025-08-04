<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Observers\AuthorObserver;
use App\Observers\BookObserver;
use App\Observers\GenreObserver;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Genre::observe(GenreObserver::class);
        Book::observe(BookObserver::class);
        Author::observe(AuthorObserver::class);
    }
}
