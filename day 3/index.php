<?php

@define('CRLF', '\r\n', TRUE);
@define('BR', '<br />', TRUE);


// 117505
// 1254


@define(FILENAME, 'day3.txt');			// filename
@define(SIZE, 1000);					// matrix size
@define(SYMBOL, '<b>X</b>');			// symbol for crossing
@define(SHOW_DATA, false);				// show output data?


// create matrix
$ArrayFabric = array_fill(0, SIZE, array_fill(0, SIZE, null));


// open file with string: #1337 @ 147,879: 21x13
$InputDataByLines = file(FILENAME);


$inches = 0;
foreach ($InputDataByLines as $line) {
	// line is empty?
	if (empty(trim($line))) continue;

	echo (SHOW_DATA ? $line : null);			// output current string

	preg_match_all("/#(\d+)\s@\s(\d+),(\d+):\s(\d+)x(\d+)/", trim($line), $point);


	/* FILL MATRIX BY SQUARES */
	$NameNumber  = $point[1][0];

	$xCoordinate = $point[2][0];	// coord X
	$yCoordinate = $point[3][0];	// coord Y

	$xWidth  = $point[4][0];		// width
	$yHeight = $point[5][0];		// height

	$x = 0;
	$y = 0;
	for ($x = $xCoordinate; $x < ($xCoordinate + $xWidth); $x++) {
		for ($y = $yCoordinate; $y < ($yCoordinate + $yHeight); $y++) {
			// check: cell is empty?
			if (isset($ArrayFabric[ $x ][ $y ])) {
				$ArrayFabric[ $x ][ $y ] = SYMBOL;
			} else {
				// write number if cell is empty
				$ArrayFabric[ $x ][ $y ] = $NameNumber;
			}

		}
	}
}


/*
	Calculate all cells > 1
*/
for ($x = 0; $x < SIZE; $x++) {
	for ($y = 0; $y < SIZE; $y++) {
		if ($ArrayFabric[ $x ][ $y ] == SYMBOL) {
			$inches++;
		}
	}
}



/*
	OUTPUT MATRIX FOR CHECKING
*/

echo '<pre><div style="font-size:' . (count($ArrayFabric) >= 50 ? '5px' : '18pt') .'">';

for ($x = 0; $x < SIZE; $x++) {
	for ($y = 0; $y < SIZE; $y++) {
		echo empty($ArrayFabric[$x][$y]) ? '0' : $ArrayFabric[$x][$y];
	}
	echo "<br />";
}
echo "</div></pre>";


echo BR . "<hr /><pre>";
print BR . "Inches: " . $inches;
