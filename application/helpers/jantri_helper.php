<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function jantri_business_date($now)
{
    $now->setTimezone(new DateTimeZone('Asia/Kolkata'));
    return ($now->format('H:i:s') < '14:00:00') ? $now->modify('-1 day')->format('Y-m-d') : $now->format('Y-m-d');
}

function jantri_cutoff_datetime($businessDate, $shiftTime)
{
    $timestamp = strtotime($shiftTime);
    if ($timestamp === false) return false;
    $time = date('H:i:s', $timestamp);
    $date = $time < '14:00:00' ? date('Y-m-d', strtotime($businessDate . ' +1 day')) : $businessDate;
    return DateTime::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time, new DateTimeZone('Asia/Kolkata'));
}

function jantri_automatic_cells($rows)
{
    $table = array();
    foreach ($rows as $row) {
        $numbers = explode(',', $row['trnno']);
        $amounts = explode(',', $row['trn_amt']);
        if (count($numbers) !== count($amounts)) continue;
        foreach ($numbers as $index => $number) {
            $number = trim($number);
            $amount = (float)$amounts[$index];
            $amount -= ((isset($row['dhissa']) ? (float)$row['dhissa'] : 0) * $amount / 100);
            $amount -= ((isset($row['tppercentage']) ? (float)$row['tppercentage'] : 0) * $amount / 100);
            $amount = max(0, $amount);
            $matches = array();
            if (strlen($number) <= 2) $matches[] = (int)$number ?: 100;
            elseif (strlen($number) === 3 && $number[0] === $number[1] && $number[1] === $number[2]) for ($i = 0; $i <= 9; $i++) $matches[] = (int)($i . $number[0]) ?: 100;
            elseif (strlen($number) === 4 && $number[0] === $number[1] && $number[1] === $number[2] && $number[2] === $number[3]) for ($i = 0; $i <= 9; $i++) $matches[] = (int)($number[0] . $i) ?: 100;
            if (!$matches) continue;
            foreach ($matches as $match) $table[$match] = (isset($table[$match]) ? $table[$match] : 0) + ($amount / count($matches));
        }
    }
    $cells = array();
    for ($i = 1; $i <= 100; $i++) $cells[$i] = round(floor(isset($table[$i]) ? $table[$i] : 0) / 5) * 5;
    return $cells;
}
