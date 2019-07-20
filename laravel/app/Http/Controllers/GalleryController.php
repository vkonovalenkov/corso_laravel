<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;
use LaraCourse\Album;
use LaraCourse\Models\AlbumCategory;
use LaraCourse\Models\Photo;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->with('categories')->get();

        //dd(Album::latest()->get());
        return view('gallery.albums')->with('albums',
            $albums
            );
    }
    public function showAlbumByCategory(AlbumCategory $category){
        return view('gallery.albums')->with('albums',
            $category->albums
        );
    }
    public function showAlbumImages(Album $album)
    {
        return view(
            'gallery.images',
            [
                'images'=>Photo::whereAlbumId($album->id)->latest()->get(),
                'album'=>$album
            ]
        );

    }
}
