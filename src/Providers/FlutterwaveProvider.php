<?php

declare(strict_types=1);
namespace Paydeck\Providers;
use Paydeck\Contracts\PaymentProviderInterface;
use Paydeck\Enums\PaymentProviderCodeEnum;

class FlutterwaveProvider implements PaymentProviderInterface
{
  /**
   * @return string
   */
  public function getProviderCode(): string
  {
    return PaymentProviderCodeEnum::FLUTTERWAVE->value;
  }
}
