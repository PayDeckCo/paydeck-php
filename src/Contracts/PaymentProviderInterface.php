<?php

declare(strict_types=1);
namespace Paydeck\Contracts;

interface PaymentProviderInterface
{
 /**
  * @return string
  */
 public function getProviderCode(): string;

}
