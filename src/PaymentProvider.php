<?php

declare(strict_types=1);
namespace Paydeck\Src;
use Paydeck\Src\Exceptions\InvalidPaymentProviderException;
use Paydeck\Src\Providers\FlutterwaveProvider;
use Paydeck\Src\Providers\PaystackProvider;

final class PaymentProvider
{
  /**
   * @param string $provider
   * @return FlutterwaveProvider|PaystackProvider
   */
  public static function setProvider(string $provider)
  {
    return match (strtoupper($provider)) {
      'FLUTTERWAVE' => new FlutterwaveProvider(),
      'PAYSTACK' => new PaystackProvider(),
      default => throw new InvalidPaymentProviderException('Invalid payment provider')
    };
  }
}
