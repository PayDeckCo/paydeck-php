<?php

namespace Paydeck\Enums;

enum PaymentMethodEnum: string
{
  case CARD = 'CARD';
  case BANK_TRANSFER = 'BANK_TRANSFER';
  case USSD = 'USSD';
  case MOBILE_MONEY = 'MOBILE_MONEY';
  case BANK_ACCOUNT = 'BANK_ACCOUNT';
  case QR_CODE = 'QR_CODE';
}
