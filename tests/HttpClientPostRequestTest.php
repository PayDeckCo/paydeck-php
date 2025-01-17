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

// Testing post request
it('makes a successful http post request with array data', function () {
  $data = ['email' => 'tom@gmail.com'];
  $this->curl_mock->shouldReceive('post')
    ->with($this->base_url . '/users', $data, true)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->post('users', $data, true);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http post request with object data', function () {
  $data = (object)['email' => 'tom@gmail.com'];
  $this->curl_mock->shouldReceive('post')
    ->with($this->base_url . '/users', $data, true)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->post('users', $data, true);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http post request with string data', function () {
  $data = 'Raw string data';
  $this->curl_mock->shouldReceive('post')
    ->with($this->base_url . '/users', $data, true)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->post('users', $data, true);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http post request with empty data', function () {
  $this->curl_mock->shouldReceive('post')
    ->with($this->base_url . '/users', [], true)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->post('users', [], true);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('throws an exception on http post request error', function () {
  $this->curl_mock->error = true;
  $this->curl_mock->error_code = 500;
  $this->curl_mock->error_message = 'Internal server error';

  $data = ['name' => 'John'];
  $this->curl_mock->shouldReceive('post')
    ->with($this->base_url . '/users', $data, true)
    ->andReturnSelf();

  $this->http->curl = $this->curl_mock;
  expect(fn() => $this->http->post('users', $data, true))
    ->toThrow(HttpClientException::class, 'Internal server error');
});

afterEach(function () {
  Mockery::close();
});