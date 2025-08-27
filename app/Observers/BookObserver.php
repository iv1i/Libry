<?php

namespace App\Observers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        $authUser = Auth::user();

        if ($authUser){
            Log::channel('library')->info(
                "Book created: {$book->title} (ID: {$book->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
            );
        }
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        $authUser = Auth::user();

        if ($authUser){
            Log::channel('library')->info(
                "Book updated: {$book->title} (ID: {$book->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
            );
        }
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        $authUser = Auth::user();

        if ($authUser){
            Log::channel('library')->info(
                "Book deleted: {$book->title} (ID: {$book->id}) | By User: {$authUser->name} (ID: {$authUser->id})"
            );
        }
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
