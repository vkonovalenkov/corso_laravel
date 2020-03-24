<?php

use Illuminate\Database\Seeder;
use LaraCourse\Models\AlbumCategory;
//use LaraCourse\Models\AlbumsCategory;

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
            //Commento lezione 187 e uso factory
            /*AlbumCategory::create(
                ['category_name'=> $cat,'user_id'=>1]
            );*/
            factory(AlbumCategory::class)->create([
                'category_name' => $cat,
                'user_id'=>1
            ]);
        }
    }
}
