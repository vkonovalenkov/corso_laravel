<?php

use Illuminate\Database\Seeder;
use LaraCourse\Album;
use LaraCourse\Models\Photo;

class seedPhotosTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $albums = Album::get();
        foreach ($albums as $album){
            factory(Photo::class,200)->create(
                ['album_id'=> $album->id]
            );
        }

    }
}
