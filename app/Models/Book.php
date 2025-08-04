<?php

namespace App\Models;

use App\Observers\BookObserver;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use HasEvents;
    protected $fillable = ['title', 'description', 'author_id', 'type'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\BookFactory::new();
    }
}
