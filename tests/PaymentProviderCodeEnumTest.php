<?php

namespace Paydeck\Tests;
use Paydeck\Enums\PaymentProviderCodeEnum;

it('has the correct payment provider enum values', function (): void {
  expect(PaymentProviderCodeEnum::FLUTTERWAVE->value)
    ->toBeString()
    ->toBeUppercase()
    ->toBeTruthy()
    ->toBe('FLUTTERWAVE');

  expect(PaymentProviderCodeEnum::PAYSTACK->value)
    ->toBeString()
    ->toBeUppercase()
    ->toBeTruthy()
    ->toBe('PAYSTACK');
});
