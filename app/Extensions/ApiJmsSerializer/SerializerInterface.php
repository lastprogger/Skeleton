<?php

namespace App\Extensions\ApiJmsSerializer;

use App\Exceptions\Api\ApiException;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;

/**
 * Interface SerializerInterface
 * @package JMS\Serializer
 */
interface SerializerInterface
{
    /**
     * Deserializes the given data to the specified type.
     *
     * @param string $data
     * @param string $type
     * @param string $format
     * @param DeserializationContext|null $context
     *
     * @return object|array|scalar
     * @throws ApiException
     * @throws \Throwable
     */
    public function apiDeserialize($data, $type, $format, DeserializationContext $context = null);

    /**
     * Converts objects to an array structure.
     *
     * This is useful when the data needs to be passed on to other methods which expect array data.
     *
     * @param mixed $data anything that converts to an array, typically an object or an array of objects
     * @param SerializationContext|null $context
     *
     * @return array
     */
    public function toArray($data, SerializationContext $context = null);
}
