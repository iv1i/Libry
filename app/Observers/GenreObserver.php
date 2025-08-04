<?php

namespace App\Observers;

use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GenreObserver
{
    /**
     * Handle the Genre "created" event.
     */
    public function created(Genre $genre): void
    {
        $authUser = Auth::user();
        Log::channel('library')->info(
            "Genre created: {$genre->title} (ID: {$genre->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
        );
    }

    /**
     * Handle the Genre "updated" event.
     */
    public function updated(Genre $genre): void
    {
        $authUser = Auth::user();
        Log::channel('library')->info(
            "Genre updated: {$genre->title} (ID: {$genre->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
        );
    }

    /**
     * Handle the Genre "deleted" event.
     */
    public function deleted(Genre $genre): void
    {
        $authUser = Auth::user();
        Log::channel('library')->info(
            "Genre deleted: {$genre->title} (ID: {$genre->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
        );
    }

    /**
     * Handle the Genre "restored" event.
     */
    public function restored(Genre $genre): void
    {
        //
    }

    /**
     * Handle the Genre "force deleted" event.
     */
    public function forceDeleted(Genre $genre): void
    {
        //
    }
}
