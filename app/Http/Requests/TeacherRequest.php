<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
    public function rules()
    {
        $validations = [
            'teacher_name' => 'required|string',
            'teacher_email' => 'required|string|unique:users,email',
            'teacher_password' => 'required|string|min:6|confirmed',
            'teacher_sex' => 'required',
            'teacher_birth_place' => 'required|string',
            'teacher_birth_date' => 'required',
            'teacher_image' => 'required|image|mimes:jpeg|max:200',
            'province_id' => 'required',
            'city_id' => 'required',
            'teacher_address' => 'required|string',
            'teacher_postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'teacher_phone_number' => 'required',
            'teacher_wa_number' => 'required',
            'teacher_facebook_url' => 'required',
            'teacher_instagram_url' => 'required'
        ];

        if ($this->get('_method') == 'patch') {
            $validations['teacher_email'] = 'required|string|unique:users,email,'.$this->get('teacher_id');
            $validations['teacher_image'] = 'image|mimes:jpeg|max:200';
            unset($validations['teacher_password']);
        } 

        return $validations;  
    }
}
