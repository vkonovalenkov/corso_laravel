<?php

use Illuminate\Database\Seeder;
use LaraCourse\Album;
use LaraCourse\Models\AlbumCategory;
use LaraCourse\Models\Photo;
use LaraCourse\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         User::truncate();
         Album::truncate();
         Photo::truncate();
         AlbumCategory::truncate();
         $this->call(seedUserTable::class);

         $this->call(SeedAlbumCategoriesTable::class);
         $this->call(seedAlbumTable::class);
         $this->call(seedPhotosTable::class);


    }

}
