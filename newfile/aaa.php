<?php


//уникални елементи да запиша в нов масив
//       [0,1,2,3,4,5,6,7,8,9,0,1,2,3,4]
$masiv = [a,b,b,c];

	if ( ($masiv[0] != $masiv[1]) && ($masiv[1] != $masiv[2]) && ($masiv[2] != $masiv[3]) ){
		echo $masiv[0].$masiv[1].$masiv[2].$masiv[3];
	}
	/*if ($masiv[1]!=$masiv[2]) {
		echo $masiv[1];
	}
	if ($masiv[2]!=$masiv[0]) {
		echo $masiv[2];
	}
	if ($masiv[3]!=$masiv[2]) {
		echo $masiv[3];
	}*/

/*$m = array_unique($masiv);
foreach ($m as $v) {
	echo $v;
}*/
