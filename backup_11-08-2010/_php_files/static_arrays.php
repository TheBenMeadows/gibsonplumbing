<?php

	//static_arrays.php

	$states = array(

			'SEL' => 'Select One',

			'NA' => 'Not Applicable',

			'AL' => 'Alabama',

			'AK' => 'Alaska', 

			'AZ' => 'Arizona', 

			'AR' => 'Arkansas',

			'CA' => 'California',

			'CO' => 'Colorado',

			'CT' => 'Connecticut',

			'DE' => 'Delaware',

			'DC' => 'Dist Columbia',

			'FL' => 'Florida',

			'GA' => 'Georgia',

			'HI' => 'Hawaii',

			'ID' => 'Idaho',

			'IL' => 'Illinois',

			'IN' => 'Indiana',

			'IA' => 'Iowa',

			'KS' => 'Kansas',

			'KY' => 'Kentucky',

			'LA' => 'Louisiana',

			'ME' => 'Maine',

			'MD' => 'Maryland',

			'MA' => 'Massachusetts',

			'MI' => 'Michigan',

			'MN' => 'Minnesota',

			'MS' => 'Mississippi',

			'MO' => 'Missouri',

			'MT' => 'Montana',

			'NE' => 'Nebraska',

			'NV' => 'Nevada', 

			'NH' => 'New Hampshire',

			'NJ' => 'New Jersey',

			'NM' => 'New Mexico',

			'NY' => 'New York',

			'NC' => 'North Carolina',

			'ND' => 'North Dakota',

			'OH' => 'Ohio',

			'OK' => 'Oklahoma',

			'OR' => 'Oregon',

			'PA' => 'Pennsylvania',

			'RI' => 'Rhode Island',

			'SC' => 'South Carolina',

			'SD' => 'South Dakota',

			'TN' => 'Tennessee',

			'TX' => 'Texas',

			'UT' => 'Utah',

			'VT' => 'Vermont',

			'VA' => 'Virginia',

			'WA' => 'Washington',

			'WV' => 'West Virginia',

			'WI' => 'Wisconsin',

			'WY' => 'Wyoming'

		   );

	$months = array(

			'Jan' =>'January',

			'Feb' =>'February',

			'Mar'=>'March',

			'Apr'=>'April',

			'May'=>'May',

			'Jun'=>'June',

			'Jul'=>'July',

			'Aug'=>'August',

			'Sep'=>'September',

			'Oct'=>'October',

			'Nov'=>'November',

			'Dec'=>'December'

			);

	//Set the start and end year year in the following variables to produce a list of years

	$start_year = (date("Y")-25);

	$end_year = date("Y");

	unset($year);

	$year=array();

	for ($i = $end_year; $i>$start_year - 1;$i--)

		{

			$year[] .=$i;

		}

	$counter1_limit = 15;

	unset($counter1);

	$counter1=array();

	for ($i = 1; $i<$counter1_limit+1;$i++)

		{

			$counter1[] .=$i;

		}

?>