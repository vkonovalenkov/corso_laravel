<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;
use View;

class PageController extends Controller
{
    protected $data=[
            [
                'name'=>'Hidran',
                'lastname'=>'Sarias'
            ],
            [
                'name'=>'James',
                'lastname'=>'Blond'
            ],
            [
                'name'=>'Harry',
                'lastname'=>'Ploter'
            ]
    ];
    public function about()
    {
        $view = app('view');
        //return view('about');
        return view('about');
        //return View::make('about');
    }
    public function blog()
    {
        $view = app('view');
        //return view('blog');
        //return view('blog');
        return view('blog',
            [
                'img_url'=> 'http://lorempixel.com/400/200',
                'img_title'=> 'Immagine Inclusa',
                'slot'=> ''
            ]
            );
        //return View::make('blog');
    }
    public function staff()
    {
        /*return view('staff',
            [
                'title'=>'Our staff',
                'staff'=>$this->data
            ]);
        */
        /*return view('staff')
            ->with('staff',$this->data)
            ->with('title','Our staff')
        ;
        */
        //return view('staff')->withStaff($this->data)->withTitle('Our staff');

        $staff =  $this->data;
        $title ='our staff';
        return view('staffb',compact('title','staff'));

    }
}
