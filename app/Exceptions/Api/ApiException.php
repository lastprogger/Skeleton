<?php

namespace App\Exceptions\Api;

use Illuminate\Http\Response;
use Throwable;

/**
 * Class Exception
 *
 * @package App\Exceptions\Api
 */
class ApiException extends \Exception
{
    /**
     * @var array|null
     */
    private $errorDetail;

    /**
     * ApiException constructor.
     *
     * @param int            $code
     * @param null|string    $message
     * @param array|null     $errorDetail
     * @param null|Throwable $previous
     */
    public function __construct(
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        ?string $message = null,
        ?array $errorDetail = null,
        ?Throwable $previous = null
    ) {
        if ($message === null && isset(Response::$statusTexts[$code])) {
            $message = $message ?? Response::$statusTexts[$code];
        }

        if ($message !== null) {
            $message = strtoupper($message);
        }
        $this->code        = $code;
        $this->message     = $message;
        $this->errorDetail = $errorDetail;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string|null $message
     * @param array       $errorDetail
     *
     * @throws ApiException
     */
    public static function badRequest(string $message = null, array $errorDetail = []): void
    {
        throw new static(Response::HTTP_BAD_REQUEST, $message, $errorDetail);
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getErrorDetail(): ?array
    {
        return $this->errorDetail;
    }

    /**
     * @param array|null $errorDetail
     *
     * @return $this
     */
    public function setErrorDetail(array $errorDetail = null): self
    {
        $this->errorDetail = $errorDetail;

        return $this;
    }
}
