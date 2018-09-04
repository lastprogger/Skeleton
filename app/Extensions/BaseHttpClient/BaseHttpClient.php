<?php
/**
 * Created by PhpStorm.
 * User: neduck
 * Date: 06/08/2018
 * Time: 16:25
 */

namespace App\Extensions\BaseHttpClient;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Response;

class BaseHttpClient
{
    /**
     * @var GuzzleHttpClient
     */
    private $guzzleHttpClient;

    /**
     * AbstractHttpClient constructor.
     *
     * @param string $baseUri
     * @param array  $headers
     * @param array  $config
     */
    public function __construct(string $baseUri, array $headers = [], array $config = [])
    {
        $httpClient = app(GuzzleHttpClient::class);

        $httpClientConfig                    = $httpClient->getConfig();
        $httpClientConfig['base_uri']        = $baseUri;
        $httpClientConfig['allow_redirects'] = false;
        $httpClientConfig['http_errors']     = false;
        $httpClientConfig['headers']         = array_merge(
            [
                'content-type' => 'application/json',
                'accept'       => 'application/json',
            ],
            $headers
        );

        $httpClientConfig = array_merge($httpClientConfig, $config);

        $this->guzzleHttpClient = new GuzzleHttpClient($httpClientConfig);
    }

    /**
     * @param string $endpoint
     * @param array  $body
     * @param array  $headers
     * @param array  $multipart
     *
     * @return string
     * @throws BadResponseCodeException
     */
    public function post(string $endpoint, array $body = [], array $headers = [], array $multipart = []): string
    {
        \Log::debug(
            'Making a request to POST ' . $endpoint,
            [
                'uri' => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
            ]
        );

        $options = [
            'headers' => array_merge($this->guzzleHttpClient->getConfig('headers'), $headers),
        ];

        if (!empty($multipart)) {
            $options['multipart'] = $multipart;
        } else {
            $options['body'] = json_encode($body);
        }

        $httpResponse = $this->guzzleHttpClient->post(
            $endpoint,
            $options
        );

        if ($httpResponse->getStatusCode() !== Response::HTTP_OK) {
            \Log::error(
                'HTTP Response code on POST ' . $endpoint . ' is not ok',
                [
                    'uri'  => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
                    'code' => $httpResponse->getStatusCode(),
                ]
            );

            throw new BadResponseCodeException(
                'HTTP Response code on POST ' . $endpoint . ' is not ok',
                $httpResponse->getStatusCode()
            );
        }

        return $httpResponse->getBody()->getContents();
    }

    /**
     * @param string $endpoint
     * @param array  $query
     * @param array  $headers
     *
     * @return string
     * @throws BadResponseCodeException
     */
    public function get(string $endpoint, array $query = [], array $headers = []): string
    {
        \Log::debug(
            'Making a request to GET ' . $endpoint,
            [
                'uri' => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
            ]
        );

        $httpResponse = $this->guzzleHttpClient->get(
            $endpoint,
            [
                'query'   => $query,
                'headers' => array_merge($this->guzzleHttpClient->getConfig('headers'), $headers),
            ]
        );

        if ($httpResponse->getStatusCode() !== Response::HTTP_OK) {
            \Log::error(
                'HTTP Response code on GET ' . $endpoint . ' is not ok',
                [
                    'uri'  => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
                    'code' => $httpResponse->getStatusCode(),
                ]
            );

            throw new BadResponseCodeException(
                'HTTP Response code on GET ' . $endpoint . ' is not ok',
                $httpResponse->getStatusCode()
            );
        }

        return $httpResponse->getBody()->getContents();
    }

    /**
     * @param string $endpoint
     * @param array  $body
     * @param array  $headers
     * @param array  $multipart
     *
     * @return string
     * @throws BadResponseCodeException
     */
    public function put(string $endpoint, array $body = [], array $headers = [], array $multipart = []): string
    {
        \Log::debug(
            'Making a request to PUT ' . $endpoint,
            [
                'uri' => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
            ]
        );

        $options = [
            'headers' => array_merge($this->guzzleHttpClient->getConfig('headers'), $headers),
        ];

        if (!empty($multipart)) {
            $options['multipart'] = $multipart;
        } else {
            $options['body'] = json_encode($body);
        }

        $httpResponse = $this->guzzleHttpClient->put(
            $endpoint,
            $options
        );

        if ($httpResponse->getStatusCode() !== Response::HTTP_OK) {
            \Log::error(
                'HTTP Response code on PUT ' . $endpoint . ' is not ok',
                [
                    'uri'  => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
                    'code' => $httpResponse->getStatusCode(),
                ]
            );

            throw new BadResponseCodeException(
                'HTTP Response code on PUT ' . $endpoint . ' is not ok',
                $httpResponse->getStatusCode()
            );
        }

        return $httpResponse->getBody()->getContents();
    }

    /**
     * @param string $endpoint
     * @param array  $body
     * @param array  $headers
     *
     * @return string
     * @throws BadResponseCodeException
     */
    public function delete(string $endpoint, array $body = [], array $headers = []): string
    {
        \Log::debug(
            'Making a request to DELETE ' . $endpoint,
            [
                'uri' => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
            ]
        );

        $httpResponse = $this->guzzleHttpClient->delete(
            $endpoint,
            [
                'body'    => json_encode($body),
                'headers' => array_merge($this->guzzleHttpClient->getConfig('headers'), $headers),
            ]
        );

        if ($httpResponse->getStatusCode() !== Response::HTTP_OK) {
            \Log::error(
                'HTTP Response code on DELETE ' . $endpoint . ' is not ok',
                [
                    'uri'  => $this->guzzleHttpClient->getConfig('base_uri') . $endpoint,
                    'code' => $httpResponse->getStatusCode(),
                ]
            );

            throw new BadResponseCodeException(
                'HTTP Response code on DELETE ' . $endpoint . ' is not ok',
                $httpResponse->getStatusCode()
            );
        }

        return $httpResponse->getBody()->getContents();
    }
}
