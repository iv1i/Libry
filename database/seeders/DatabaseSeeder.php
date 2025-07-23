<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create genres
        $genres = Genre::factory(10)->create();

        // Create authors with books
        Author::factory(5)
            ->has(Book::factory()->count(10)) // Каждый автор получит 10 книг
            ->create()
            ->each(function ($author) use ($genres) {
                // Для каждой книги автора привяжем жанры
                $author->books->each(function ($book) use ($genres) {
                    $book->genres()->attach(
                        $genres->random(rand(1, 3))->pluck('id')
                    );
                });
            });
    }
}
