<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
//        khai báo 1 mảng
        $rules = [];
//        Lấy phương thức đang hoạt động
        $method = $this->route()->getActionMethod();
        switch ($this->method()){
            case 'POST':
                switch ($method){
                    case 'add': // hàm nào gọi đến
                        $rules = [
                            'name' => 'required',
                            'phone' => 'required|unique:users,phone',
                            'address'=>'required',
                            'gender' => 'required',
                            'image' => 'nullable|required|image|mimes:png,jpg,PNG,jpec',
                            'password' => 'required|min:6',
                            'email'=> 'required|email|unique:users,email'
                        ];
                        break;
                    case 'edit': // hàm nào gọi đến
                        $rules = [
                            'name' => 'required'
                        ];
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;

        }

        return $rules;
    }
    public function  messages()
    {
        return [
            'name.required'=> 'Không được bỏ trống tên',
        ];

    }
}
