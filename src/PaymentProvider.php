<?php

declare(strict_types=1);
namespace Paydeck;
use Paydeck\Contracts\PaymentProviderInterface;
use Paydeck\Exceptions\InvalidPaymentProviderException;
use Paydeck\Providers\FlutterwaveProvider;
use Paydeck\Providers\PaystackProvider;

final class PaymentProvider
{
  /**
   * @param string $provider
   * @return PaymentProviderInterface
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
