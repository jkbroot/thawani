<?php

namespace Jkbroot\Thawani\Helpers;

class ValidationHelper
{
    public static function validateSessionData(array $data, array $requiredFields, array $productFields)
    {
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new \InvalidArgumentException("Missing required field: {$field}");
            }
        }

        if ($data['mode'] !== 'payment') {
            throw new \InvalidArgumentException("Invalid mode value. Expected 'payment', got '{$data['mode']}'");
        }

        self::validateProducts($data['products'], $productFields);
        self::validateUrls($data['success_url'], $data['cancel_url']);
    }

    private static function validateProducts(array $products, array $productFields)
    {
        if (empty($products)) {
            throw new \InvalidArgumentException("Products must be a non-empty array");
        }

        foreach ($products as $product) {
            foreach ($productFields as $field) {
                if (!isset($product[$field])) {
                    throw new \InvalidArgumentException("Missing required field in product: {$field}");
                }
            }

            if ($product['quantity'] < 1 || $product['unit_amount'] < 1) {
                throw new \InvalidArgumentException("Product quantity and unit_amount must be at least 1");
            }
        }
    }

    private static function validateUrls(string $successUrl, string $cancelUrl)
    {
        if (!filter_var($successUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("Invalid success URL");
        }

        if (!filter_var($cancelUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("Invalid cancel URL");
        }
    }
}
