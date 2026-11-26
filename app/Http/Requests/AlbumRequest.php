<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool //this è la richiesta http in ingresso
    {
        $album = $this->route('album');

        if($album)
            return $album->user_id === Auth::id();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('album'); //il route model binding mi restituisce l'oggetto album dal db preso l'id nel parametro album dell'uri
        //dd($id);
        $res = [
            'album_name' => ['required'], //su create deve essere univoco su albums, su update deve essere // ma senza contare il record corrente, deve essere valorizzato come array per poter fare append, sulle stringhe non si può fare
            'description' => 'required',
            //'user_id'
        ];
        if($id){
            //caso update
            $res['album_name'][] = Rule::unique('albums')->ignore($id);
        } else {
            //caso create
            $res['file_path'] = 'required|image';
            $res['album_name'][] = Rule::unique('albums'); //fa append sull'array esistente
        }
        return $res;
    }

    public function messages():array
    {
        return [
            'album_name.required' => 'il campo nome è obbligatorio',
            'album_name.unique' => 'esiste già un album con questo nome',
            'description.required' => 'il campo descrizione è obbligatorio',
            'file_path.required' => 'il campo immagine è obbligatorio',
        ];
    }
}
