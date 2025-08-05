<?php

namespace App\Services\Public;

use App\Models\Book;
use App\Services\Service;

class BookService extends Service
{
    public static function show(Book $book): Book
    {
        return $book->load('author', 'genres');
    }
}
