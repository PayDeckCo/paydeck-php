<?php

namespace Paydeck\Tests;
use Curl\Curl;
use Mockery;
use Paydeck\Src\Exceptions\HttpClientException;
use Paydeck\Src\Utility\HttpClient;


beforeEach(function () {
  $this->base_url = 'https://api.example.com';
  $this->curl_mock = Mockery::mock(Curl::class);
  $this->http = new HttpClient($this->base_url, ['Authorization' => 'Bearer test-token']);
});

//Testing get request
it('makes a successful http get request', function () {
  $params = ['query' => 'tom'];
  $this->curl_mock->shouldReceive('get')
    ->with($this->base_url . '/users', $params)
    ->once()
    ->andReturn($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->get('users', $params);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('throws an exception on http get request error', function () {
  $this->curl_mock->error = true;
  $this->curl_mock->error_code = 500;
  $this->curl_mock->error_message = 'Internal server error';

  $this->curl_mock->shouldReceive('get')
    ->with($this->base_url . '/users', [])
    ->andReturnSelf();

  $this->http->curl = $this->curl_mock;
  expect(fn() => $this->http->get('users'))
    ->toThrow(HttpClientException::class, 'Internal server error');
});

it('makes http get request with empty query parameters', function () {
  $this->curl_mock->shouldReceive('get')
    ->with($this->base_url . '/users', [])
    ->andReturnSelf();
  $this->curl_mock->error = false;

  $this->http->curl = $this->curl_mock;
  $response = $this->http->get('users', []);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

afterEach(function () {
  Mockery::close();
});