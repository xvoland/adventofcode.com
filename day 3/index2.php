<?php
@define('CRLF', '\r\n', true);
@define('BR', '<br />', true);


// 117505
// 1254


@define('FILENAME', './day3.txt');      // filename
@define('SIZE', 1000);                  // matrix size


// create matrix
$ArrayFabric = array_fill(0, SIZE, array_fill(0, SIZE, 0));


// open file with string: #1337 @ 147,879: 21x13
$InputDataByLines = file(FILENAME);


$inches       = 0;
$inches_part2 = 0;
foreach ($InputDataByLines as $line) {
    // line is empty?
    if(empty(trim($line)))
        continue;

    //echo $line;           // output current string

    preg_match_all("/#(\d+)\s@\s(\d+),(\d+):\s(\d+)x(\d+)/", trim($line), $point);


    /* FILL MATRIX BY SQUARES */
    $xCoordinate = $point[2][0];    // coord X
    $yCoordinate = $point[3][0];    // coord Y

    $xWidth  = $point[4][0];        // width
    $yHeight = $point[5][0];        // height

    for ($x = $xCoordinate; $x < ($xCoordinate + $xWidth); $x++) {
        for ($y = $yCoordinate; $y < ($yCoordinate + $yHeight); $y++) {
            $ArrayFabric[ $x ][ $y ] += 1;
        }
    }
}


/*
    Calculate all cells > 1
*/
for ($x = 0; $x < SIZE; $x++) {
    for ($y = 0; $y < SIZE; $y++) {
        if ($ArrayFabric[ $x ][ $y ] > 1) {
            $inches++;
        }
    }
}


foreach ($InputDataByLines as $line) {

    preg_match_all("/#(\d+)\s@\s(\d+),(\d+):\s(\d+)x(\d+)/", trim($line), $point);


    /* FILL MATRIX BY SQUARES */
    $xCoordinate = $point[2][0];    // coord X
    $yCoordinate = $point[3][0];    // coord Y

    $xWidth  = $point[4][0];        // width
    $yHeight = $point[5][0];        // height

    $tmp = true;
    for ($x = $xCoordinate; $x < ($xCoordinate + $xWidth); $x++) {
        for ($y = $yCoordinate; $y < ($yCoordinate + $yHeight); $y++) {
            if ($ArrayFabric[ $x ][ $y ] > 1) {
                $tmp = false;
            }
        }
    }

    if ($tmp) {
        for ($x = $xCoordinate; $x < ($xCoordinate + $xWidth); $x++) {
            for ($y = $yCoordinate; $y < ($yCoordinate + $yHeight); $y++) {
                $ArrayFabric[ $x ][ $y ] = '<b style="color:red">' . $ArrayFabric[ $x ][ $y ] . "</b>";

                $inches_part2++;
            }
        }
    }
}

/*
    OUTPUT MATRIX FOR CHECKING
*/

echo '<pre><div style="font-size:' . (count($ArrayFabric) >= 50 ? '5px' : '18pt') . '">';

for ($x = 0; $x < SIZE; $x++) {
    for ($y = 0; $y < SIZE; $y++) {
        echo $ArrayFabric[$x][$y];
    }
    echo "<br />";
}
echo "</div></pre>";


print BR . "Inches: " . $inches;
print BR . "Clear rectangles: " . $inches_part2;

echo BR . "<hr /><pre>";
//print_r($ArrayFabric);

