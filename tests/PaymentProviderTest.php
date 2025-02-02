<?php

namespace Paydeck\Tests;
use Paydeck\Src\Enums\PaymentProviderEnum;
use Paydeck\Src\Exceptions\InvalidPaymentProviderException;
use Paydeck\Src\PaymentProvider;
use Paydeck\Src\Providers\FlutterwaveProvider;
use Paydeck\Src\Providers\PaystackProvider;


it('returns the correct payment provider instance', function (): void {
  expect(PaymentProvider::setProvider(PaymentProviderEnum::PAYSTACK->value))
    ->toBeInstanceOf(PaystackProvider::class);

  expect(PaymentProvider::setProvider(PaymentProviderEnum::FLUTTERWAVE->value))
    ->toBeInstanceOf(FlutterwaveProvider::class);
});

it('invalid provider throws an invalid payment provider exception', function (): void {
  PaymentProvider::setProvider('INVALID_PROVIDER');
})->throws(InvalidPaymentProviderException::class, 'Invalid payment provider');