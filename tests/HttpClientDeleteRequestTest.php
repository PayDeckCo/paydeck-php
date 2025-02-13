<?php

namespace Paydeck\Tests;
use Curl\Curl;
use Mockery;
use Paydeck\Exceptions\HttpClientException;
use Paydeck\Utility\HttpClient;


beforeEach(function () {
  $this->base_url = 'https://api.example.com';
  $this->curl_mock = Mockery::mock(Curl::class);
  $this->http = new HttpClient($this->base_url, ['Authorization' => 'Bearer test-token']);
});

it('makes a successful http delete request with array data', function () {
  $data = ['type' => 'Jane'];
  $this->curl_mock->shouldReceive('delete')
    ->with($this->base_url . '/users', $data, false)
    ->once()
    ->andReturn($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->delete('users', $data, false);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http delete request with empty data', function () {
  $this->curl_mock->shouldReceive('delete')
    ->with($this->base_url . '/users', [], false)
    ->once()
    ->andReturn($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->delete('users', [], false);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http delete request with array data as payload', function () {
  $data = ['active' => 1];
  $as_payload = true;

  $this->curl_mock->shouldReceive('delete')
    ->with($this->base_url . '/users', $data, $as_payload)
    ->once()
    ->andReturn($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->delete('users', $data, $as_payload);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('throws an exception on http delete request error', function () {
  $this->curl_mock->error = true;
  $this->curl_mock->error_code = 500;
  $this->curl_mock->error_message = 'Internal server error';

  $data = ['name' => 'John'];
  $this->curl_mock->shouldReceive('delete')
    ->with($this->base_url . '/users', $data, false)
    ->andReturnSelf();

  $this->http->curl = $this->curl_mock;
  expect(fn() => $this->http->delete('users', $data, false))
    ->toThrow(HttpClientException::class, 'Internal server error');
});

afterEach(function () {
  Mockery::close();
});
