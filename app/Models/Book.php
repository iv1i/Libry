<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    #[Scope]
    public function filterByTitle(Builder $query, ?string $title): Builder
    {
        return $query->when($title, fn($q) => $q->where('title', 'like', "%{$title}%"));
    }

    #[Scope]
    public function filterByAuthorName(Builder $query, ?string $authorName): Builder
    {
        return $query->when($authorName, function ($q) use ($authorName) {
            $author = Author::where('name', $authorName)->first();
            return $q->when($author, fn($q) => $q->where('author_id', $author->id));
        });
    }

    #[Scope]
    public function filterByGenres(Builder $query, ?string $genres): Builder
    {
        return $query->when($genres, function ($q) use ($genres) {
            $genreNames = explode(',', $genres);
            return $q->whereHas('genres', fn($q) => $q->whereIn('name', $genreNames));
        });
    }

    #[Scope]
    public function sortByTitle(Builder $query, ?string $sort): Builder
    {
        return $query->when($sort === 'title', fn($q) => $q->orderBy('title'));
    }

    protected static function newFactory()
    {
        return \Database\Factories\BookFactory::new();
    }
}
