<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;
use LaraCourse\Album;
use LaraCourse\Models\Photo;

class GalleryController extends Controller
{
    public function index()
    {
            //dd(Album::latest()->get());
        return view('gallery.albums')->with('albums',
                Album::latest()->get()
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
