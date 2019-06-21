<?php

namespace LaraCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaraCourse\Album;

class AlbumUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //$this->id = 1;
        $album = Album::find($this->id);
        if(\Gate::denies('manage-album',$album)){

            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:albums,album_name',
            'description' => 'required'
            //,'user_id'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il nome del\'almum è obbligatorio',
            'description.required' => 'La desrizione del\'almum è obbligatorio',
            'album_thumb.required' => 'L\'immagine del\'almum è obbligatorio'
        ];
    }
}
