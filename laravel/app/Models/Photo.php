<?php

namespace LaraCourse\Models;

use Illuminate\Database\Eloquent\Model;
use LaraCourse\Album;


/**
 * @property mixed image_path
 */
class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable =['name','image_path','description'];

    public function album(){
        //$this>$this->belongsTo(Album::class,'album_id','id');
        return $this->belongsTo(Album::class);
    }
    //img path
    public function getPathAttribute()
    {
        $url = $this->image_path;
        if(stristr($url,'http') === false){
            $url = 'storage/'.$url;
        }
        return $url;

    }

    public function getImagePathAttribute($value)
    {

        if(stristr($value,'http') === false){
            $value = 'storage/'.$value;
        }
        return $value;

    }

    public function setNameAttribute($value)
    {

        $this->attributes['name'] = strtoupper($value);

    }


}
