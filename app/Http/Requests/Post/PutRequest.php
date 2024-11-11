<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
{
    /*
        Este lo creamos temporalmente para evitar la validacion del SLUG al editar una categoria
        ya que por defecto tendriamos que cambiarla porque no acepta repetidas
    */
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    { 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:500',
            //Esto campo no se debe cambiar
            // Tenemos que indicar de manera dinamica ya que depende del post que queremos actualizar
            // donde le indicaremos que para cierto campo en especifico nos haga una restriccion para el Id en especifico
            // (Excluimos el Slug) indicando el nombre del campo de la BD "slug" a continuacion ponemos el 
            // identificador que queremos excluir que seria el ID de la ruta actual
            // Colocamos afuero lo de la ruta que es "post" porque es el nombre del parametro de la ruta
            // Estamos accediendo al parametro de la ruta de: post/{post}/edit
            'slug' => 'required|min:5|max:500, slug,'.$this->route('post')->id,
            'content' => 'required|min:7',
            'category_id' => 'required|integer',
            'description' => 'required|min:7',
            'posted' => 'required',
            // VALIDACION PARA LA IMAGEN
            // Sera opcional porque solo se podra agregar el Tener ya un post Registrado
            // mimes: Tipos de Extenciones que vamos a soportar
            // max: para indicar el tamano maximo que es equivalente en MEGAS
            'image' => 'mimes:jpeg,jpg,png|max:10240',
        ];
    }
}
