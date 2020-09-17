<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class SaveRolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return mixed
     */
    public function authorize()
    {
        return true;
//        return Gate::authorize('update', $this->route('role'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'display_name' => 'required',
        ];
//        dd(request()->method());
        if(request()->method() === 'POST') {
            $rules['name'] = 'required|unique:roles';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El <strong>identificador</strong> es obligatorio',
            'name.unique' => 'Este <strong>identificador</strong> ya ha sido registrado',
            'display_name.required' => 'El <strong>nombre</strong> es obligatorio',
        ];
    }
}
