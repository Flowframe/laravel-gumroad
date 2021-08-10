<?php

use Flowframe\Gumroad\GumroadPing;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::post('/gumroad/webhook', function () {
    $gumroadPing = new GumroadPing(
        ...request([
            'sale_id',
            'sale_timestamp',
            'order_number',
            'seller_id',
            'product_id',
            'product_permalink',
            'short_product_id',
            'email',
            'url_params',
            'full_name',
            'purchaser_id',
            'subscription_id',
            'ip_country',
            'price',
            'recurrence',
            'variants',
            'offer_code',
            'test',
            'custom_fields',
            'shipping_information',
            'is_recurring_charge',
            'is_preorder_authorization',
            'license_key',
            'quantity',
            'shipping_rate',
            'affiliate',
            'affiliate_credit_amount_cents',
            'is_gift_receiver_purchase',
            'gifter_email',
            'gift_price',
            'refunded',
            'discover_fee_charged',
            'can_contact',
            'referrer',
            'gumroad_fee',
            'card',
        ]),
    );

    $product = collect(config('gumroad.products'))->firstWhere('short_product_id', $gumroadPing->short_product_id);

    throw_if(is_null($product), "Could not find product: {$gumroadPing->short_product_id}");

    throw_if(empty($product['actions']), "Actions are required for product: {$gumroadPing->short_product_id}");

    foreach ($product['actions'] as $action) {
        throw_unless(class_exists($action), "Action `{$action}` doesn't exist");

        new ($action)($gumroadPing, $product['data']);
    }

    return response('', Response::HTTP_OK);
})->middleware('web');
