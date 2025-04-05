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
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'area_code' => ['required', 'digits_between:1,5', 'numeric'],
            'exchange_code' => ['required', 'digits_between:1,5', 'numeric'],
            'subscriber_code' => ['required', 'digits_between:1,5', 'numeric'],
            'address' => ['required'],
            'type' => ['required'],
            'content' => ['required', 'max:120'],
        ];

    }

    public function messages(){
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'area_code.required' => '電話番号を入力してください',
            'exchange_code.required' => '電話番号を入力してください',
            'subscriber_code.required' => '電話番号を入力してください',
            'area_code.numeric' => '電話番号は数字で入力してください',
            'exchange_code.numeric' => '電話番号は数字で入力してください',
            'subscriber_code.numeric' => '電話番号は数字で入力してください',
            'area_code.digits_between' => '電話番号は5桁までの数字で入力してください',
            'exchange_code.digits_between' => '電話番号は5桁までの数字で入力してください',
            'subscriber_code.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'type.required' => 'お問い合わせの種類を選択してください',
            'content.required' => 'お問い合わせ内容を入力してください',
            'content.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
