<?php
/**
 * Created by PhpStorm.
 * User: urijmaslov
 * Date: 24.10.17
 * Time: 16:21
 */

namespace App\Extensions\ApiJmsSerializer;

use App\Exceptions\Api\ApiException;
use App\Exceptions\Api\TokenExpiredException;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer as JmsSerializer;
use Log;

class Serializer implements SerializerInterface
{
    /**
     * @var JmsSerializer
     */
    protected $serializerBuild;

    /**
     * Serializer constructor.
     *
     * @param JmsSerializer $serializer
     */
    public function __construct(JmsSerializer $serializer)
    {
        $this->serializerBuild = $serializer;
    }

    /**
     * @inheritdoc
     */
    public function toArray($data, SerializationContext $context = null)
    {
        if (null === $context) {
            return $this->serializerBuild->toArray($data);
        }

        return $this->serializerBuild->toArray($data, $context);
    }

    /**
     * @inheritdoc
     */
    public function apiDeserialize($data, $type, $format, DeserializationContext $context = null)
    {
        try {
            /**
             * @var ApiException $apiException
             */
            $apiException = $this->serializerBuild->deserialize(
                $data,
                ApiException::class,
                'json'
            );
            if (null !== $apiException->getCode()) {
                if ($apiException->getCode() === 460
                    && $apiException->getMessage() === 'TOKEN IS EXPIRED') {
                        Log::error($apiException);
                        throw new TokenExpiredException($apiException->getCode(), $apiException->getMessage());
                }

                if ($apiException->getCode() === Response::HTTP_UNAUTHORIZED
                    && $apiException->getMessage() === 'UNAUTHORIZED') {
                        Log::error($apiException);
                        throw new AuthenticationException();
                }

                if ($apiException->getCode() === Response::HTTP_FORBIDDEN
                ) {
                    Log::error($apiException);

                    throw new AuthorizationException(Response::$statusTexts[Response::HTTP_FORBIDDEN]);
                }

                Log::error($apiException);

                throw new ApiException(
                    $apiException->getCode(),
                    $apiException->getMessage(),
                    $apiException->getErrorDetail()
                );
            }

            if (null === $context) {
                return $this->serializerBuild->deserialize($data, $type, $format);
            }

            return $this->serializerBuild->deserialize($data, $type, $format, $context);
        } catch (ApiException $apiException) {
            throw $apiException;
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }
}
