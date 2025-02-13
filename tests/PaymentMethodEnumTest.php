<?php

namespace Paydeck\Tests;
use Paydeck\Enums\PaymentMethodEnum;

it('has correct enum cases', function () {
  $cases = PaymentMethodEnum::cases();
  expect($cases)->toContain(PaymentMethodEnum::CARD);
  expect($cases)->toContain(PaymentMethodEnum::BANK_TRANSFER);
  expect($cases)->toContain(PaymentMethodEnum::USSD);
  expect($cases)->toContain(PaymentMethodEnum::MOBILE_MONEY);
  expect($cases)->toContain(PaymentMethodEnum::BANK_ACCOUNT);
  expect($cases)->toContain(PaymentMethodEnum::QR_CODE);
});

it('has correct enum values', function () {
  expect(PaymentMethodEnum::CARD->value)->toBe('CARD');
  expect(PaymentMethodEnum::BANK_TRANSFER->value)->toBe('BANK_TRANSFER');
  expect(PaymentMethodEnum::USSD->value)->toBe('USSD');
  expect(PaymentMethodEnum::MOBILE_MONEY->value)->toBe('MOBILE_MONEY');
  expect(PaymentMethodEnum::BANK_ACCOUNT->value)->toBe('BANK_ACCOUNT');
  expect(PaymentMethodEnum::QR_CODE->value)->toBe('QR_CODE');
});
