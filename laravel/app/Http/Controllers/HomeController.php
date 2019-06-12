<?php
/**
 * Created by PhpStorm.
 * User: vkono
 * Date: 19/03/2019
 * Time: 00:57
 */

namespace LaraCourse\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $req){
        return 'Hello World!!'.$req->input('name');
    }
}
