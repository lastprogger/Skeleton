<?php
/**
 * Created by PhpStorm.
 * User: neduck
 * Date: 06/08/2018
 * Time: 16:25
 */

namespace App\Extensions\BaseHttpClient;

use App\Extensions\ApiJmsSerializer\SerializerInterface;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Response;
use JMS\Serializer\ArrayTransformerInterface;

class BadResponseCodeException extends \Exception
{
}
