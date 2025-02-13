<?php

namespace Paydeck\Tests;
use Paydeck\Enums\PaymentProviderCodeEnum;
use Paydeck\Exceptions\InvalidPaymentProviderException;
use Paydeck\PaymentProvider;
use Paydeck\Providers\FlutterwaveProvider;
use Paydeck\Providers\PaystackProvider;


it('returns the correct payment provider instance', function (): void {
  expect(PaymentProvider::setProvider(PaymentProviderCodeEnum::PAYSTACK->value))
    ->toBeInstanceOf(PaystackProvider::class);

  expect(PaymentProvider::setProvider(PaymentProviderCodeEnum::FLUTTERWAVE->value))
    ->toBeInstanceOf(FlutterwaveProvider::class);
});

it('invalid provider throws an invalid payment provider exception', function (): void {
  PaymentProvider::setProvider('INVALID_PROVIDER');
})->throws(InvalidPaymentProviderException::class, 'Invalid payment provider');
