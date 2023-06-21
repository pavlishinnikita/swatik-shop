<?php

namespace App\Http\Requests;

use App\Constants\GoodBuyingProcessConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class OrderDataRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nickname' => Rule::when(in_array(intval($this->step), [
                GoodBuyingProcessConstant::STEP_GOOD_DETAILS,
                GoodBuyingProcessConstant::STEP_BUY_GOOD,
            ]), [
                'required',
                'max:16',
                'not_regex:/[А-Яа-яЁё ]/u'
            ]),
            'count' => Rule::when(in_array(intval($this->step), [
                GoodBuyingProcessConstant::STEP_GOOD_DETAILS,
                GoodBuyingProcessConstant::STEP_BUY_GOOD,
                ]), [
                'numeric',
                'min:20'
            ]),
            'email' => Rule::when(in_array(intval($this->step), [
                GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT,
                GoodBuyingProcessConstant::STEP_BUY_GOOD,
                ]), [
                'required',
                'email',
            ]),
            'paymentMethod' => Rule::when(in_array(intval($this->step), [
                GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT,
                GoodBuyingProcessConstant::STEP_BUY_GOOD,
            ]), [
                'required',
            ]),
            'paymentType' => Rule::when(in_array(intval($this->step), [
                GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT,
                GoodBuyingProcessConstant::STEP_BUY_GOOD,
            ]), [
                'required',
            ]),
            'good_id' => 'integer',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function messages()
    {
        return [
            'nickname.required' => 'Никнейм обязательное поле',
            'nickname.max' => 'Никнейм максимум 16 символов',
            'nickname.not_regex' => 'Никнейм содержит недопустимые символы',
            'email.required' => 'Имейл обязательное поле',
            'email.email' => 'Имейл имеет неправильный формат',
            'payment.required' => 'Выбор платежной системы обязателен',
            'count.numeric' => 'Колличество должно быть целым числом',
            'count.min' => 'Минимальное колличество для покупки - 20шт',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
