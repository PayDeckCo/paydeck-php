<?php

namespace Paydeck\Tests;
use Paydeck\Src\Enums\PaymentProviderEnum;

it('has the correct payment provider enum values', function (): void {
  expect(PaymentProviderEnum::FLUTTERWAVE->value)
    ->toBeString()
    ->toBeUppercase()
    ->toBeTruthy()
    ->toBe('FLUTTERWAVE');

  expect(PaymentProviderEnum::PAYSTACK->value)
    ->toBeString()
    ->toBeUppercase()
    ->toBeTruthy()
    ->toBe('PAYSTACK');
});