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
            'nickname' => Rule::when(intval($this->step) === GoodBuyingProcessConstant::STEP_GOOD_DETAILS, [
                'required',
                'max:16'
            ]),
            'email' => Rule::when(intval($this->step) === GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT, [
                'required',
                'email',
            ]),
            'paymentMethod' => Rule::when(intval($this->step) === GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT, [
                'required',
            ]),
            'paymentType' => Rule::when(intval($this->step) === GoodBuyingProcessConstant::STEP_CHOOSE_PAYMENT, [
                'required',
            ]),
            'step' => 'numeric|gt:0|max:' . GoodBuyingProcessConstant::MAX_STEPS,
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
            'email.required' => 'Имейл обязательное поле',
            'email.email' => 'Имейл имеет неправильный формат',
            'payment.required' => 'Выбор платежной системы обязателен',
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
