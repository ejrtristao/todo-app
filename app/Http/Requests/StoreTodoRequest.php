<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'todo.required' => 'A tarefa é obrigatória',
            'todo.min' => 'A tarefa deve ter no mínimo 3 caracteres',
            'todo.max' => 'A tarefa não pode ter ser maior que 255 caracteres',
            'description.required' => 'A Descrição é obrigatória',
            'description.min' => 'A Descrição deve ter no mínimo 3 caracteres',
            'description.max' => 'A Descrição não pode ter ser maior que 255 caracteres',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'todo' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }
}
