<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == '/confirm') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'lastname' => 'required',
        'firstname' => 'required',
        'email' => 'required|email',
        'postcode' => 'required',
        'address' => 'required',
        'opinion' =>'required|max:120',
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => '姓を入力してください',
            'firstname.required' => '名を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'postcode.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
            'opinion.required' => 'お問い合わせ内容を入力してください'
        ];
    }
}
