<?php

$monate = [
    1  => "Januar",
    2  => "Februar",
    3  => "M&auml;rz",
    4  => "April",
    5  => "Mai",
    6  => "Juni",
    7  => "Juli",
    8  => "August",
    9  => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Dezember",
];

$timestamp = null;



if (isset($dateString) === true && is_object($dateString) === true && method_exists($dateString, 'toDate') === true) {
    $timestamp = $dateString->toDate();
} elseif (isset($dateString) === true && is_string($dateString) === true && trim($dateString) !== '') {
    $timestamp = strtotime($dateString);
} else {
    // Fallbacks: akzeptiere weitere Typen (z.B. Field ohne toDate, DateTime, int)
    if ($dateString instanceof DateTimeInterface) {
        $timestamp = $dateString->getTimestamp();
    } elseif (is_int($dateString) === true) {
        $timestamp = $dateString;
    } elseif (is_object($dateString) === true && method_exists($dateString, 'value') === true) {
        $value = $dateString->value();
        if (is_string($value) === true && trim($value) !== '') {
            $timestamp = strtotime($value);
        }
    } elseif (is_object($dateString) === true && method_exists($dateString, '__toString') === true) {
        $value = (string)$dateString;
        if (trim($value) !== '') {
            $timestamp = strtotime($value);
        }
    }
}

if ($timestamp === null || $timestamp === false) {
    return;
}

$publishedDay   = (int)date('j', $timestamp);
$publishedMonth = (int)date('n', $timestamp);
$publishedYear  = (int)date('Y', $timestamp);
$monthName      = $monate[$publishedMonth] ?? null;

if ($monthName === null) {
    return;
}

?>
<?= $publishedDay ?>. <?= $monthName ?> <?= $publishedYear ?>