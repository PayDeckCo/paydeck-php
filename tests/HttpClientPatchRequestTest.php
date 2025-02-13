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

// Testing patch request
it('makes a successful http patch request with array data', function () {
  $data = ['email' => 'tom@gmail.com'];
  $this->curl_mock->shouldReceive('patch')
    ->with($this->base_url . '/users', $data, true, false)
    ->andReturnSelf($this->curl_mock);

  //$this->curl_mock->shouldReceive('close')->once();
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->patch('users', $data, true, false);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http patch request with object data', function () {
  $data = (object)['email' => 'tom@gmail.com'];
  $this->curl_mock->shouldReceive('patch')
    ->with($this->base_url . '/users', $data, true, true)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->patch('users', $data, true, true);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http patch request with string data', function () {
  $data = 'Raw string data';
  $this->curl_mock->shouldReceive('patch')
    ->with($this->base_url . '/users', $data, true, false)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->patch('users', $data, true, false);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('makes a successful http patch request with empty data', function () {
  $this->curl_mock->shouldReceive('patch')
    ->with($this->base_url . '/users', [], true, false)
    ->andReturnSelf($this->curl_mock);
  $this->curl_mock->error = false;

  // Replace the real Curl instance with our mock
  $this->http->curl = $this->curl_mock;
  $response = $this->http->patch('users', [], true, false);

  expect($response)
    ->toBe($this->curl_mock)
    ->toBeInstanceOf(Curl::class);
});

it('throws an exception on http patch request error', function () {
  $this->curl_mock->error = true;
  $this->curl_mock->error_code = 500;
  $this->curl_mock->error_message = 'Internal server error';

  $data = ['name' => 'John'];
  $this->curl_mock->shouldReceive('patch')
    ->with($this->base_url . '/users', $data, true, false)
    ->andReturnSelf();

  $this->http->curl = $this->curl_mock;
  expect(fn() => $this->http->patch('users', $data, true, false))
    ->toThrow(HttpClientException::class, 'Internal server error');
});

afterEach(function () {
  Mockery::close();
});
