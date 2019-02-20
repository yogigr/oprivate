<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'student_name' => 'required|string',
            'student_email' => 'required|string|unique:users,email',
            'student_password' => 'required|string|min:6|confirmed',
            'student_sex' => 'required',
            'student_birth_place' => 'required|string',
            'student_birth_date' => 'required',
            'student_image' => 'required|image|mimes:jpeg|max:200',
            'province_id' => 'required',
            'city_id' => 'required',
            'student_address' => 'required|string',
            'student_postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'student_phone_number' => 'required',
            'student_wa_number' => 'required',
            'student_facebook_url' => 'required',
            'student_instagram_url' => 'required'
        ];

        if ($this->get('_method') == 'patch') {
            $validations['student_email'] = 'required|string|unique:users,email,'.$this->get('student_id');
            $validations['student_image'] = 'image|mimes:jpeg|max:200';
            unset($validations['student_password']);
        } 

        return $validations; 
    }
}
