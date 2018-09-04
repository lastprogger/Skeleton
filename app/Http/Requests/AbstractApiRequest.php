<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractApiRequest extends FormRequest
{
    public const CUSTOM_HEADER_LANGUAGE    = '-x-belkacar-language';
    public const CUSTOM_HEADER_APP_VERSION = '-x-belkacar-appversion';
    public const CUSTOM_HEADER_OS_NAME     = '-x-belkacar-os';
    public const CUSTOM_HEADER_DEVICE_TYPE = '-x-belkacar-device';
    public const CUSTOM_HEADER_AUTH_TOKEN  = '-x-belkacar-auth-token';
    public const CUSTOM_HEADER_DEVICE_ID   = '-x-belkacar-device-id';
    public const CUSTOM_HEADER_CLIENT_IP   = '-x-belkacar-client-ip';

    public const CUSTOM_HEADER_REQUEST_INITIATOR_USER_ID   = '-x-belkacar-request-initiator-user-id';
    public const CUSTOM_HEADER_REQUEST_INITIATOR_USER_ROLE = '-x-belkacar-request-initiator-user-role';

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
        $requestInitiatorUserId = $this->header(self::CUSTOM_HEADER_REQUEST_INITIATOR_USER_ID);

        return \is_int($requestInitiatorUserId)
               || 1 === preg_match('/^\d+$/', $requestInitiatorUserId);
    }

    /**
     * @return int
     */
    public function getInitiatorUserId(): int
    {
        return (int) $this->header(self::CUSTOM_HEADER_REQUEST_INITIATOR_USER_ID);
    }

    /**
     * @return string
     */
    public function getInitiatorUserRole(): string
    {
        return $this->header(self::CUSTOM_HEADER_REQUEST_INITIATOR_USER_ROLE);
    }

    /**
     * @return string|null
     */
    public function getDeviceOs(): ?string
    {
        return $this->header(self::CUSTOM_HEADER_OS_NAME);
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->header(self::CUSTOM_HEADER_LANGUAGE);
    }

    /**
     * @return string|null
     */
    public function getAppVersion(): ?string
    {
        return $this->header(self::CUSTOM_HEADER_APP_VERSION);
    }

    /**
     * @return string|null
     */
    public function getDeviceType(): ?string
    {
        return $this->header(self::CUSTOM_HEADER_DEVICE_TYPE);
    }

    /**
     * @return null|string
     */
    public function getClientIp(): ?string
    {
        return $this->header(self::CUSTOM_HEADER_CLIENT_IP);
    }
}
