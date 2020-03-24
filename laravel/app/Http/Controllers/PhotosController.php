<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaraCourse\Album;
use LaraCourse\Models\Photo;
use Illuminate\Support\Facades\Storage;


class PhotosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Photo::class);
    }

    protected $rules = [
        'album_id' => 'required|integer|exists:albums,id',
        'name' => 'required|unique:photos,name',
       // 'description' => 'required',
        'description' => 'nullable|min:3',
        'image_path' => 'required|image'
    ];
    protected $errorMessages = [
      'album_id.required'=>'Il campo Album è obbligatorio',
      'name.required'=>'Il campo Name è obbligatorio',
      'description.required'=>'Il campo Descrizione è obbligatorio',
      'image_path.required'=>'Il Immagine è obbligatorio'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {

        $id = $req->has('album_id')?$req->input('album_id'):null;
        $album = Album::firstOrnew(['id'=>$id]);


        $photo = new Photo();
        $albums = $this->getAlbums();
        //dd($photo);
        return view('images.editimage',compact('album','photo','albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //Metodo alternativo per validare i dati del form
        //$this->validate($request,$this->rules,$this->errorMessages);
        $request->validate($this->rules,$this->errorMessages);
        //$picData = $request->validate($this->rules,$this->errorMessages);
        //dd($picData);
        //Photo::create($picData);


        $photo = new Photo();
        //dd($photo);
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $request->input('album_id');

        $this->processFile($photo);
        $photo->save();
        return redirect(route('album.getimages',$photo->album_id));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo){

        dd($photo);
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $albums = $this->getAlbums();
        $album = $photo->album;

        return view('images.editimage',compact('album','albums','photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Photo $photo)
    {
        //dd($photo);
        $this->validate($request,$this->rules);
        $this->processFile($photo);
        $photo->album_id = $request->album_id;
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $res = $photo->save();
        $messaggio =  $res ? 'Image = '.$photo->name.' Update ' : 'Photo = '.$photo->name
            .' was not updated';
        session()->flash('message',$messaggio);
        //return redirect()->route('photos.index');
        return redirect()->route('album.getimages', $photo->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $res = $photo ->delete();
        if($res){
            $this->processFile($photo);
        }
        return ''.$res;
        //return Photo::destroy($id);
    }
    public function processFile(Photo $photo, Request $req=null)
    {
        if(!$req){
            $req = request();
        }
        if(!$req->hasFile('image_path')){
            return false;
        }

        $file=$req->file('image_path');

        if(!$file->isValid()){
            return false;
        }
        //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
        $imgname = preg_replace('@[a-z0-9]i@','_',$photo->name);
        $fileName = $imgname.'.'.$file->extension();

        $file->storeAs(env('IMG_DIR').'/'.$photo->album_id, $fileName);
        $photo->image_path = env('IMG_DIR').$photo->album_id .'/'. $fileName;

        return true;

    }

    public function deleteFile(Photo $photo){
        $disk = config('filesystems.default');
        if($photo->image_path && Storage::disk($disk)->has($photo->image_path)){
           return Storage::disk($disk)->delete($photo->image_path);
        }
        return false;
    }
    public function getAlbums(){
        return Album::orderBy('album_name')->where('user_id',Auth::user()->id)->get();
    }
}
