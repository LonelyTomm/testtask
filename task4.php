<?php

$matrix = [
    [ 51, 71, 1, 50 ],
    [ 13, 5, 19, 11 ],
    [ 60, 4, 11, 20 ],
    [ 13, 34, 17, 0 ],
    [ 16, 53, 1, 32 ]
];

function getValue(int $rowIndx, int $colIndx): int {
    global $matrix;
    if ($rowIndx < 0 || $rowIndx > count($matrix) - 1) {
        return 0;
    }

    if ($colIndx < 0 || $colIndx > count($matrix[0]) - 1) {
        return 0;
    }

    return $matrix[$rowIndx][$colIndx];
}

function calcNeighbourSum(int $rowIndx, int $colIndx): int {
    $sum = 0;
    $sum += getValue($rowIndx - 1, $colIndx);
    $sum += getValue($rowIndx + 1, $colIndx);
    $sum += getValue($rowIndx, $colIndx - 1);
    $sum += getValue($rowIndx, $colIndx + 1);

    return $sum;
}

function main() {
    echo "Neighbour sum for (0,0) element is " . calcNeighbourSum(0, 0) . "\n";
    echo "Neighbour sum for (3,2) element is " . calcNeighbourSum(3, 2) . "\n";
}

main();