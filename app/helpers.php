<?php

function formatPrice (float $amount): string {
    $isNegative = $amount < 0;

    $prefix = ($isNegative ? '-' : '') . '$';
    $normalizeAmount = number_format(abs($amount), 2);
    return $prefix . $normalizeAmount;
}

function formatDate (string $date): string {
    $timestamp = strtotime($date);
    return date('M j, Y', $timestamp);
}