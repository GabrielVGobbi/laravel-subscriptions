<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasPermissionByRequestMethod(
            request()->method(),
            'user'
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->segment(3) ?? '';

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', "unique:users,email,{$id},id"],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'permissions' => 'exists:permissions,id',
            'roles' => 'exists:roles,id',
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:8', 'max:16'];
            #$rules['roles'] = ['required'];
        }

        return $rules;
    }
}
