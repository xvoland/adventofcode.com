<?php

@define('CRLF', '\r\n', TRUE);
@define('BR', '<br />', TRUE);


@define(FILENAME, 'test.txt');			// filename
@define(SIZE, 10);						// matrix size


// create matrix
$ArrayFabric = array_fill(0, SIZE, array_fill(0, SIZE, 0));


// open file with string: #1337 @ 147,879: 21x13
$InputDataByLines = file(FILENAME);


$inches = 0;
foreach ($InputDataByLines as $line) {
	// line is empty?
	if (empty(trim($line))) continue;

	echo $line;			// output current string

	preg_match_all("/\#(\d+)\s@\s(\d+),(\d+):\s(\d+)x(\d+)/", trim($line), $point);


	/* FILL MATRIX BY SQUARES */
	$xCoordinate = $point[2][0];	// coord X
	$yCoordinate = $point[3][0];	// coord Y

	$xWidth  = $point[4][0];		// width
	$yHeight = $point[5][0];		// height

	$x = 0;
	$y = 0;
	for ($x = $xCoordinate; $x < ($xCoordinate + $xWidth); $x++) {
		for ($y = $yCoordinate; $y < ($yCoordinate + $yHeight); $y++) {
			// check: cell is empty?
			if ($ArrayFabric[ $x ][ $y ] != 0) {
				$inches++;			// increase counter

				// write number if cell is empty
				// or write 'X' if cell is NOT empty
				if($ArrayFabric[ $x ][ $y ] != $point[1][0]) {
					$ArrayFabric[ $x ][ $y ] = '<b>X</b>';
				}

			} else {
				// write number if cell is empty
				$ArrayFabric[ $x ][ $y ] = $point[1][0];
			}

		}
	}
}



/*
	OUTPUT MATRIX FOR CHECKING
*/

echo '<pre>';

for ($x = 0; $x < SIZE; $x++) {
	for ($y = 0; $y < SIZE; $y++) {
		echo $ArrayFabric[$x][$y];
	}
	echo "<br />";
}
echo "</pre>";


print BR . "Inches: " . $inches;
echo BR . "<hr /><pre>";
//print_r($ArrayFabric);

