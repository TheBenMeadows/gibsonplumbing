<?php

/*This /*Copyright March, 2004

This php file is the exclusive property of Glyn Barrows.

A right to use permission is granted to DDS "Digital Display Solutions, INC." 

for use in administering the Digital Display Solutions Web Site

*/



/*

This program has two main functions - getUNIXreadyDate() AND displaySQLdate().

One additional function, getMonthNumber()is also included and is used (called)

by the getUNIXreadyDate()n function.



The getUNIXreadyDate() function will return a date in Unix timestamp format (ready for input into mySQL).

The call to the function will be 

getUNIXreadyDate($theDate, $x)



The displaySQLdate() function will format an SQL retrieved date for readability and displaying on a web page.



The call to the function will be 

displaySQLdate($theDate, $x)



$theDate will be a string which is the date to be formatted.



$x = the format code which indicates the format the existing date is in for the getUNIXreadyDate() function

or the format chosen for displaying for the displaySQLdate() function.



The following format codes are used to identify the format (in the format column). 

code    		format						example

 1        	Month date, year 			September 21, 2004

 2			date Month year			21 September 2004

 3			month/date/year			9/21/2004

 4			month/date/yr				9/21/04

 5			date/month/yr				21/09/04



Using the example column; 

The getUNIXreadyDate() return result will be 2004-09-21. 

The displaySQLdate() will use 2004/09/21 and return the format specified in the function call ($x)

*/ 



function getUNIXreadyDate($theDate, $x)

	{

		switch ($x) 

			{

				case 1:

					$theDate = ereg_replace(", ","/",$theDate);

					$theDate = ereg_replace(" ", "/",$theDate);

					/*echo ("theDate = $theDate<BR><BR>");*/

					$a = explode("/", $theDate);

					return "$a[2]-".getMonthNumber($a[0])."-$a[1]";

					break;    

				case 2:

					$theDate = ereg_replace(" ", "/",$theDate);

					$a = explode("/", $theDate);

					return "$a[2]-".getMonthNumber($a[1])."-$a[0]";

					break;    

				case 3:

					$a = explode("/", $theDate);

					return "$a[2]-$a[0]-$a[1]";

					break;    

				case 4:

					$a = explode("/", $theDate);

					$b = intval($a[2]);

					if ($b < 50)

						{

							$b = $b + 2000;

						}

					else 

						{

							$b = $b + 1900;

						}	

					return "$b-$a[0]-$a[1]";

					break;    

				case 5:

					$a = explode("/", $theDate);

					$b = intval($a[2]);

					if ($b < 50)

						{

							$b = $b + 2000;

						}

					else 

						{

							$b = $b + 1900;

						}	

					return "$b-$a[1]-$a[0]";

					break;    

			}

	}

function getMonthNumber($y)	

	{

		switch ($y)

			{

				case "January":

					return "01";

					break;

				case "February":

					return "02";

					break;

				case "March":

					return "03";

					break;

				case "April":

					return "04";

					break;

				case "May":

					return "05";

					break;

				case "June":

					return "06";

					break;

				case "July":

					return "07";

					break;

				case "August":

					return "08";

					break;

				case "September":

					return "09";

					break;

				case "October":

					return "10";

					break;

				case "November":

					return "11";

					break;

				case "December":

					return "12";

					break;

			}	

	}

function displaySQLdate($SQLdate, $format)

	{

		switch ($format) 

			{

				case 1:

					/*echo $SQLdate."<BR>";*/

					$temp_date = convert_timestamp($SQLdate);

					/*echo $temp_date."<BR>";*/

					$a = date("F d, Y",$temp_date);

					/*echo $a;*/

					return $a;

					break;    

				case 2:

					$a = date("d F Y",$SQLdate);

					/*echo $a;*/

					return $a;

					break;    

				case 3:

					$a = date("m/d/Y",$SQLdate);

					/*echo $a;*/

					return $a;

				case 4:

					$a = date("m/d/y",$SQLdate);

					/*echo $a;*/

					return $a;

				case 5:

					$a = date("d/m/y",$SQLdate);

					/*echo $a;*/

					return $a;

					break;    

			}

	}

function convert_timestamp ($timestamp)

{

    $timestring = substr($timestamp, 0, 4) . '-' .

                  substr($timestamp, 4, 2) . '-' .

                  substr($timestamp, 6, 2) . ' ' .

                  substr($timestamp, 8, 2) . ':' .

                  substr($timestamp, 10, 2) . ':' .

                  substr($timestamp, 12, 2);



    return strtotime($timestring);

}

function parse_date($data)  

	{

		//This functiion assumes that the date retrieved from the database will be in the format yyyy-mm-dd-

		$date_data = explode('-',$data);

		return $date_data;

	}	

?>

