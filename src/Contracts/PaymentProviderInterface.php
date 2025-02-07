<?php

declare(strict_types=1);
namespace Paydeck\Src\Contracts;

interface PaymentProviderInterface
{
 /**
  * @return string
  */
 public function getProviderName(): string;

}