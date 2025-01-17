<?php

namespace Paydeck\Tests;
use Paydeck\Src\Utility\HttpClient;


beforeEach(function () {
  $this->base_url = 'https://api.example.com';
  $this->http = new HttpClient($this->base_url, ['Authorization' => 'Bearer test-token']);
});

it('sets up http client constructor headers and base url correctly', function () {
  $headers = [
    'Content-Type' => 'application/json',
    'Cache-Control' => 'no-cache',
    'Authorization' => 'Bearer test-token'
  ];

  expect($this->http->base_url)->toBe($this->base_url . '/');
  foreach ($headers as $key => $value) {
    expect($this->http->headers)->toHaveKey($key);
    expect($this->http->headers[$key])->toBe($value);
  }
});

it('trims trailing slash from http client base url', function () {
  $trailing_url = 'https://api.example.com/';
  expect($this->http->base_url)->toBe($trailing_url);
});