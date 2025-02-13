<?php

declare(strict_types=1);
namespace Paydeck\Utility;
use Curl\Curl;
use Exception;
use Paydeck\Exceptions\HttpClientException;

class HttpClient
{
  /**
   * @var Curl
   */
  public $curl;

  /**
   * @var string
   */
  public $base_url;

  /**
   * @var array
   */
  public $headers = [];

  /**
   * @param string $base_url
   * @param array $headers
   */
  public function __construct(string $base_url, array $headers = [])
  {
    $curl = new Curl();
    $base_headers = [
      'Content-Type' => 'application/json',
      'Cache-Control' => 'no-cache',
    ];

    $this->headers = array_merge($base_headers, $headers);
    $this->base_url = rtrim($base_url, '/').'/';

    $this->curl = $curl;
    $this->setRequestHeaders($this->headers);
  }

  /**
   * @param array $headers
   * @return void
   */
  private function setRequestHeaders(array $headers)
  {
    if (is_array($headers) && count($headers)) {
      foreach ($headers as $key => $value) {
        $this->curl->setHeader($key, $value);
      }
    }
  }

  /**
   * @param Curl $curl
   * @throws HttpClientException
   * @return void
   */
  private function handleCurlError(Curl $curl)
  {
    if ($curl->error) {
      throw new HttpClientException($curl->error_message, $curl->error_code);
    }
  }

  /**
   * @param string $url
   * @return Curl
   */
  public function get(string $url, $data = [])
  {
    $curl = $this->curl->get($this->base_url.$url, $data);
    $this->handleCurlError($curl);
    return $curl;
  }

  /**
   * @param string $url
   * @param array|object|string $data
   * @param bool $as_json
   * @throws Exception
   * @return Curl
   */
  public function post(string $url, array|object|string $data = [], bool $as_json = true)
  {
    $curl = $this->curl->post($this->base_url.$url, $data, $as_json);
    $this->handleCurlError($curl);
    return $curl;
  }

  /**
   * @param string $url
   * @param array|object|string $data
   * @param bool $as_payload
   * @return Curl
   */
  public function delete(string $url, array|object|string $data = [], $as_payload = false)
  {
    $curl = $this->curl->delete($this->base_url.$url, $data, $as_payload);
    $this->handleCurlError($curl);
    return $curl;
  }

  /**
   * @param string $url
   * @param array|object|string $data
   * @param bool $as_payload
   * @param bool $as_json
   * @return Curl
   */
  public function patch(string $url, array|object|string $data = [], bool $as_payload = true, bool $as_json = true)
  {
    $curl = $this->curl->patch($this->base_url.$url, $data, $as_payload, $as_json);
    $this->handleCurlError($curl);
    return $curl;
  }

}
