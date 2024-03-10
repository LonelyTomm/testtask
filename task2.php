<?php

const TUESDAY_NUM = 2;
const DAYS_IN_WEEK = 7;

function countTuesdayBetweenDates(DateTime $startDate, DateTime $endDate): int {
    $interval = $endDate->diff($startDate);
    $daysCount = $interval->days;

    if ($startDate->format("N") <= TUESDAY_NUM) {
        $daysCount -= TUESDAY_NUM - $startDate->format("N");
    } else {
        $daysCount -= DAYS_IN_WEEK - $startDate->format("N") + TUESDAY_NUM;
    }

    if ($daysCount < 0) {
        return 0;
    }

    $countTuesdays = 1;
    $countTuesdays += (int)($daysCount / DAYS_IN_WEEK);

    return $countTuesdays;
}

function main() {
    $startDate = DateTime::createFromFormat("Y-m-d", "2024-04-02");
    $endDate = DateTime::createFromFormat("Y-m-d", "2024-04-02");

    echo "Total number of tuesdays between dates: " . countTuesdayBetweenDates($startDate, $endDate) . "\n";
}

main();