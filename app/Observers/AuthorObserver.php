<?php

namespace App\Observers;

use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthorObserver
{
    /**
     * Handle the Author "created" event.
     */
    public function created(Author $author): void
    {
        $authUser = Auth::user();
        Log::channel('library')->info(
            "Author created: {$author->name} (ID: {$author->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
        );
    }

    /**
     * Handle the Author "updated" event.
     */
    public function updated(Author $author): void
    {
        $authUser = Auth::user();
        Log::channel('library')->info(
            "Author updated: {$author->name} (ID: {$author->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
        );
    }

    /**
     * Handle the Author "deleted" event.
     */
    public function deleted(Author $author): void
    {
        $authUser = Auth::user();
        Log::channel('library')->info(
            "Author deleted: {$author->name} (ID: {$author->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
        );
    }

    /**
     * Handle the Author "restored" event.
     */
    public function restored(Author $author): void
    {
        //
    }

    /**
     * Handle the Author "force deleted" event.
     */
    public function forceDeleted(Author $author): void
    {
        //
    }
}
