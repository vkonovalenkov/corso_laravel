<?php

use Illuminate\Database\Seeder;
use LaraCourse\Models\AlbumCategory;
use LaraCourse\Models\AlbumsCategory;

class SeedAlbumCategoriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            'business',
            'animals',
            'city',
            'cats',
            'food',
            'nightlife',
            'fashion',
            'people',
            'sports',
            'nature',
            'technics',
            'transport'
        ];
        foreach ($cats as $cat){
            AlbumCategory::create(
                ['category_name'=> $cat]
            );
        }
    }
}
