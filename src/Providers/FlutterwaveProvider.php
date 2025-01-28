<?php

declare(strict_types=1);
namespace Paydeck\Src\Providers;
use Paydeck\Src\Contracts\PaymentProviderInterface;
use Paydeck\Src\Enums\PaymentProviderEnum;

class FlutterwaveProvider implements PaymentProviderInterface
{
  /**
   * @return string
   */
  public function getProviderName(): string
  {
    return PaymentProviderEnum::FLUTTERWAVE->value;
  }
}
