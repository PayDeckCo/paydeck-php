<?php

namespace Paydeck\Tests;
use Paydeck\Src\Enums\PaymentProviderEnum;
use Paydeck\Src\Providers\FlutterwaveProvider;
use Paydeck\Src\Providers\PaymentProvider;


it('retuns the correct payment provider instance', function (): void {

  expect(PaymentProvider::setProvider(PaymentProviderEnum::PAYSTACK->value))
    ->toBeInstanceOf(FlutterwaveProvider::class);

  expect(PaymentProvider::setProvider(PaymentProviderEnum::FLUTTERWAVE->value))
    ->toBeInstanceOf(FlutterwaveProvider::class);
});