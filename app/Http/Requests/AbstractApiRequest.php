<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractApiRequest extends FormRequest
{
    public const CUSTOM_HEADER_USER_ID   = '-x-user-id';
    public const CUSTOM_HEADER_USER_ROLE = '-x-user-role';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getInitiatorUserId(): string
    {
        return $this->header(self::CUSTOM_HEADER_USER_ID);
    }

    /**
     * @return string
     */
    public function getInitiatorUserRole(): string
    {
        return $this->header(self::CUSTOM_HEADER_USER_ROLE);
    }
}
