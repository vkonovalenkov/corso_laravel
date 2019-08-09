<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use LaraCourse\Album;
use LaraCourse\Http\Requests\AlbumUpdateRequest;
use LaraCourse\Models\AlbumCategory;
use LaraCourse\Models\AlbumsCategory;
use LaraCourse\Models\Photo;
use LaraCourse\Http\Requests\AlbumRequest;


class AlbumsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('auth')->only(['create','edit']);
        //$this->middleware('auth')->except(['index']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request )
    {
        //return Album::all();
        //$sql = 'select * from albums WHERE 1=1 ';
        //$queryBuilder = DB::table('albums')->orderBy('id','DESC');

        $queryBuilder = Album::orderBy('id','DESC')
            ->withCount('photos')->with('categories');
        //dd(Auth::user());
        //dd($request);
        $queryBuilder->where('user_id',Auth::user()->id);

        if($request->has('id')){
            $queryBuilder->where('id','=',$request->input('id'));
        }
        if($request->has('album_name')){

            $queryBuilder->where('album_name','like',$request->input('album_name').'%');
        }
        $albums = $queryBuilder->paginate(env('IMG_PER_PAGE'));
        //dd($albums);
        return view('albums.albums',['albums'=>$albums]) ;
        /*
        $where = [];
        if($request->has('id')){
            $where['id'] = $request->get('id');
            $sql .= " AND ID=:id";
        }
        if($request->has('album_name')){

            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name =:album_name";
        }
        $sql .= ' ORDER BY id DESC';
        //dd($sql);
        $albums = DB::select($sql,$where);
        */

    }

    /**
     * @param Album $album
     * @return string
     * @throws \Exception
     */
    public function delete(Album $album)
    {
        /*$sql = 'DELETE  FROM albums WHERE id=:id';
        //dd($id);
        return DB::delete($sql,['id'=>$id]);
        //return redirect()->back();
        */
        //$res = DB::table('albums')->where('id',$id)->delete();
        //$res = Album::where('id',$id)->delete();
        //$album = Album::find($id);

        //dd($album);
        //Storage
        $thumbNail = $album->album_thumb;
        $disk = config('filesystems.default');
        //dd(Storage::disk($disk)->has($thumbNail));
        $res = $album->delete();
        if($res){
            if($thumbNail && Storage::disk($disk)->has($thumbNail)){
                Storage::disk($disk)->delete($thumbNail);
            }
        }
        if(request()->ajax()){
            return ''.$res;
        }else{
            return redirect()->route('albums');
        }
    }
    public function show_album($id)
    {
        $sql = 'SELECT *  FROM albums WHERE id=:id';
        //dd($id);
        return DB::select($sql,['id'=>$id]);
        //return redirect()->back();
    }
    public function edit($id)
    {
        //$sql = 'select id,album_name,description from albums where id = :id';
        //$album = DB::select($sql,['id' => $id]);
        $album = Album::find($id);
        Auth::user()->can('update',$album);
        $this->authorize('edit',$album);
        $categories = AlbumCategory::get();
        $selectedCategories = $album->categories->pluck('id')->toArray();
        //dd($selectedCategories);
        return view('albums.editalbum')->with(
            [
                'album'=>$album,
                'categories'=>$categories,
                'selectedCategories'=>$selectedCategories
            ]
        );
    }

    public function store($id, AlbumUpdateRequest $req)
    {

        //$res = DB::table('albums')->where('id',$id)->update(
        /*$res = Album::where('id',$id)->update(
          [
              'album_name'=>request()->input('name'),
              'description'=>request()->input('description')
          ]
        );
        */
        $album = Album::find($id);
        $this->authorize('update',$album);
        /*if(\Gate::denies('manage-album',$album)){
            abort(401,'Unauthorized');
        }*/
        $album->album_name = request()->input('name');
        $album->description = request()->input('description');
        $album->user_id = $req->user()->id;
        $this->processFile($id, $req, $album);
        $res = $album->save();
        /*$data = request()->only(['name','description']);
        $data['id'] = $id;
        $sql  = 'UPDATE albums SET album_name=:name, description=:description';
        $sql .= ' WHERE id=:id';
        $res = DB::update($sql,$data);
        */
        $messaggio =  $res ? 'Album con id = '.$id.' Aggiornato ' : 'Album con did = '.$id.' Non aggiornato';
        session()->flash('message',$messaggio);
        return redirect()->route('albums');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $album = new Album();
        $categories = AlbumCategory::get();
        //dd($categories);
        return view('albums.createalbum',
            [
                'album'=>$album,
                'categories'=>$categories
            ]
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(AlbumRequest $request)
    {

        //dd(request()->all());
        /*$data = request()->only(['name','description']);
        $data['user_id'] = 1;
        $sql = 'INSERT INTO albums (album_name,description,user_id)';
        $sql .= ' VALUES (:name,:description,:user_id)';
        $res = DB::insert($sql,$data);
        */
        //$res = DB::table('albums')->insert(
        //$res = Album::insert(
        /*$res = Album::create(
            [
                [
                    'album_name'=>request()->input('name'),
                    'description'=>request()->input('description'),
                    'user_id'=>1

                ]
            ]
        );
        */
        $album = new Album();
        $album->album_name = $request->input('name');
        $album->description = $request->input('description');
        $album->user_id = $request->user()->id;

        $res = $album->save();

        if($res){
            if($request->has('categories')){
                $album->categories()->attach($request->categories);
            }
            if($this->processFile($album->id, request(), $album)){
                $album->save();
            }

        }

        $name = request()->input('name');
        $messaggio =  $res ? 'Album  '.$name.' Created ' : 'Album  = '.$name.' was not created';
        session()->flash('message',$messaggio);
        return redirect()->route('albums');

    }

    /**
     * @param $id
     * @param Request $req
     * @param $album
     */
    public function processFile($id, Request $req, &$album)
    {
        if(!$req->hasFile('album_thumb')){
            return false;
        }

        $file=$req->file('album_thumb');

        if(!$file->isValid()){
            return false;
        }
        //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
        $fileName=$id . '.' . $file->extension();
        $file->storeAs(env('ALBUM_THUMB_DIR'), $fileName);
        $album->album_thumb=env('ALBUM_THUMB_DIR') . $fileName;

        return true;

    }

    public function getImages(Album $album)
    {
        //dd($album);
        //$images = Photo::where('album_id', $album->id)->get();
        $images = Photo::where('album_id', $album->id)->latest()->paginate(env('IMG_PER_PAGE'));
        return view('images.albumimages', compact('album','images'));
    }

    public function show(Album $album){
        echo 'SHOW';
        dd($album);
    }



}
