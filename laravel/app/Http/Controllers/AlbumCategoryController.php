<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaraCourse\Http\Requests\AlbumCategoryRequest;
use LaraCourse\Models\AlbumCategory;

class AlbumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = AlbumCategory::where('user_id',Auth::id())->withCount('albums')->latest()->paginate(5);
        //$categories = Auth::user()->albumCategories()->withCount('albums')->latest()->paginate(5);
        $categories = AlbumCategory::getCategoriesByUserId(Auth::user())->paginate(5);
        //dd($categories);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new AlbumCategory();

        return view('categories.managecategory',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumCategoryRequest $request)
    {
        $category = new AlbumCategory();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::id();
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumCategory $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AlbumCategory $category)
    {
        return view('categories.managecategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlbumCategory $category)
    {
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlbumCategory $category)
    {
        $res = $category->delete();
        return redirect()->route('categories.index');
    }
}
