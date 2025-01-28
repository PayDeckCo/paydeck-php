<?php

declare(strict_types=1);
namespace Paydeck\Src\Providers;
use Paydeck\Src\Contracts\PaymentProviderInterface;
use Paydeck\Src\Enums\PaymentProviderEnum;

class PaystackProvider implements PaymentProviderInterface
{
  /**
   * @return string
   */
  public function getProviderName(): string
  {
    return PaymentProviderEnum::PAYSTACK->value;
  }
}
