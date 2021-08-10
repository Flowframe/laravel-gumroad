<?php

namespace Flowframe\Gumroad;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class GumroadPing
{
    public function __construct(
        public string $sale_id,
        public string $sale_timestamp,
        public string $order_number,
        public string $seller_id,
        public string $product_id,
        public string $product_permalink,
        public string $short_product_id,
        public string $email,
        public array $url_params = [],
        public ?string $full_name = null,
        public ?string $purchaser_id,
        public ?string $subscription_id = null,
        public ?string $ip_country,
        public int $price,
        public ?string $recurrence = null,
        public ?array $variants = [],
        public ?string $offer_code = null,
        public ?string $test,
        public array $custom_fields = [],
        public array $shipping_information = [],
        public ?bool $is_recurring_charge = null,
        public ?bool $is_preorder_authorization = null,
        public ?string $license_key = null,
        public int $quantity,
        public ?int $shipping_rate = null,
        public ?string $affiliate = null,
        public ?int $affiliate_credit_amount_cents = null,
        public bool $is_gift_receiver_purchase,
        public ?string $gifter_email = null,
        public ?int $gift_price = null,
        public bool $refunded,
        public bool $discover_fee_charged,
        public bool $can_contact,
        public string $referrer,
        public int $gumroad_fee,
        public array $card,
    ) {
    }

    protected function formatAmount(int $cents): string
    {
        $money = new Money($cents, new Currency('USD'));
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }

    public function price(): string
    {
        return $this->formatAmount($this->price);
    }

    public function shippingRate(): ?string
    {
        return $this->formatAmount($this->shipping_rate);
    }

    public function affiliateCreditAmount(): ?string
    {
        return $this->formatAmount($this->affiliate_credit_amount_cents);
    }

    public function giftPrice(): ?string
    {
        return $this->formatAmount($this->gift_price);
    }

    public function gumroadFee(): ?string
    {
        return $this->formatAmount($this->gumroad_fee);
    }
}
