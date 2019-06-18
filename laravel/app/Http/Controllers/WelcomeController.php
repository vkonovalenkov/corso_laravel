<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome($name='',$lastname='',$age='',Request $req){
        $language = $req->input('lang');
        $res = '<h1>hello world '.$name.' '.$lastname.' you are '.$age.' yers old and your languege is '.$language.'</h1>';
        return $res;

    }
}
