<?php
	if(!function_exists('stripos'))
		{
			function stripos($haystack,$needle,$offset = 0)
				{
					return(strpos(strtolower($haystack),strtolower($needle),$offset));
				}
		}
	if(!function_exists("str_ireplace"))
		{
			function str_ireplace($find, $replace, $string)
				{
					$find = strtolower($find);
					$replace = strtolower($replace);
					$string = strtolower($string);
					return str_replace($find, $replace, $string);
				}
		}
function create_image($f_name,$requested_width,$requested_height,$src_folder,$final_target_folder,$type_of_image)
	{

/*		echo("In create_image - - - <BR>f_name = ".$f_name."<BR>requested_width =".$requested_width."<BR>requested_height = ".$requested_height."<BR>src_folder = ".$src_folder."<BR>final_target_folder = ".$final_target_folder."<BR>type_of_image =".$type_of_image."<BR>");

		This function will create a resized image, store it onto the hard drive, and pass the name of the resized image back 
		to the calling statement.
		For this to work these two variables must be set prior to the calling statement being invoked.  
		NOTE: It is recommended these not be	set as session variables.
		$image_source_folder_path - the path to the source images which must currently exist on the server.
			eg.
			$image_source_folder_path = "images/";
		$image_target_folder_path - the path to the final resized image location.  This folder must already exist.	
			eg.
			$image_target_folder_path = "images_made/";
		The calling statement  aguments for this are as follows: 
			$f_name - this is the original image which was previously uploaded.  
			$requested_width - The preferred width of the resized image,  (if zero, then this will be ignored)
			$requested_height - The preferred height of the resized image,  (if zero, then this will be ignored)
			$src_folder - This is the folder that the source (or uploaded image) is in.  
								  This must include the path from the root of the site.
			$final_target_folder - This is the folder where the resized image is to be placed. 
								This must include the path from the root of the site.
			$type_of_image -  this specifies 'thumb' for a thumbnail or 'regular' for a normal sized image
		FUNCTION DESCRIPTION  
		If both $requested_width and $requested_height are zero, then the $type_of_image will be checked to determine if
		a thumbnail or regular sized image is being requested.
		If only one of the two are zero, then the non-zero dimension will be used.  The orignal image aspect ratio will be used 
		to determine the other dimension.  
		If both are provided, then the aspect ratio of these required thumnail dimensions will be compared to the original images aspect ratio.
		If the requested size image has an aspect ration (w/h) is larger than the aspect ratio of the original image, then the height will be the control dimension.
		If the requested size image has an aspect ration (w/h) is smaller than the aspect ratio of the original image, then the height will be the control dimension.
		This will be a three step process.
		STEP 1:	
			determine the controlling dimension
		STEP2:
			create the resized image using the controlling dimension and the original images aspect ratio
		STEP3:
			crop the resized to match the required thumbnail dimensions.
		FUNCTION FLOW
		1.  get the original images information.
		2.  determine the aspect ratio(s).
		3.  determine file type
		3.	 build the resized imgae...crop if required.
*/				
		//1.  get the original images information.
		//load variables with the size attributes of the picture as uploaded
		//echo("66 GD function - src_folder/f_name =".$src_folder."/".$f_name."<BR><BR>");
		list($width,$height,$type,$attr)=getimagesize($src_folder."/".$f_name);
		//2.  determine the aspect ratio situation.
		//		get the original images aspect ratio
		$orig_ar = $width/$height;	
		//Set the resized image's dimensions.
		// 	-Check the dimensions provided as arguments to this function:
		//			There are four possibilities
		//				-neither are provided (both == 0)
		//				-only requested height is provided
		//				-only requested width is provided
		// 			-both dimensions are provided
		if ($requested_width == 0 && $requested_height == 0)
			{
				if ($type_of_image == "thumb")
					{
						$fixed_width = 150;
						//$mod = "_thumb";
					}
				else
					{
						$fixed_width = 550;
						//$mod = "_regular";
					}	
				$final_width = $fixed_width;
				$final_height = $height *($fixed_width/$width);
			}
		else if ($requested_height == 0)
			{
				$final_width = $requested_width;
				$final_height = $height *($requested_width/$width);
			}	
		else if ($requested_width	 == 0)
			{
				$final_height = $requested_height;
				$final_width = $width *($requested_height/$height);
			}
		else
			{
				//both dimensions are provided
				//get the requested size aspect ratio
				$final_ar = $requested_width/$requested_height;
				// determine cropping requirement
				if ($orig_ar > $final_ar)
					{
						//this will occur if the resized image's width is to be less, when compared to its height, than the original image
						//this will require the picture to be cropped.  
						//In this case, the original image will be reduced by maintaining the aspect ratio of the requested image and
						//using the resized image's requested height as the controlling dimension.  
						//The width of the resized image will be cropped to the requested width.
						//$width = $final_ar * $height;
						$final_height = $height*($requested_width/$width);
						$final_width = $requested_width;
					}
				else if 	($orig_ar < $final_ar)
					{
						//this will occur if the resized image's height is to be less, when compared to its width, than the original image
						//this will require the picture to be cropped.  
						//In this case, the original image will be reduced by maintaining the aspect ratio of the requested image and
						//using the resized image's requested width as the controlling dimension.  
						//The height of the resized image will be cropped to the requested height.
						//$height = $width/$final_ar;
						$final_width = $width*($requested_height/$height);
						$final_height =  $requested_height;
					}
				else
					{	
						$final_height = $requested_height;
						$final_width = $requested_width ;
					}
			}
		//echo("In GD - - type of file = ".$type."<BR>");
		switch ($type)
			{
				case 1:
					$ext = ".gif";
					break;
				case 2:
					$ext = ".jpg";
					break;
				case 3:
					$ext = ".png";
					break;
			}
		//Get the image 
		$temp_final = get_the_image($f_name,$type,$src_folder."/");
		//prepare an image mask for the work space
		/*
						echo("<BR>original width  = ".$width."<BR>");
						echo("requested width = ".$requested_width."<BR>");
						echo("final width = ".$final_width."<BR><BR>");
						echo("original height = ".$height."<BR>");
						echo("requested height = ".$requested_height."<BR>");
						echo("final_height = ".$final_height."<BR><BR>");
		*/
		$temp_image_mask = imagecreatetruecolor($final_width,$final_height); 
		//Put the image in the work space
		imagecopyresampled($temp_image_mask,$temp_final,0,0,0,0,$final_width,$final_height,$width,$height);
		
		switch ($type)
			{
				case 1:
					imagegif($temp_image_mask, $final_target_folder.$f_name,60);
					imagedestroy($temp_image_mask);
					break;
				case 2:
					imagejpeg($temp_image_mask, $final_target_folder.$f_name,60);
					imagedestroy($temp_image_mask);
					break;
				case 3:
					imagepng($temp_image_mask, $final_target_folder.$f_name,60);
					imagedestroy($temp_image_mask);
					break;
			}
		//return $final_file_name;
	}
function get_the_image($img,$type,$folder_name)
	{
		switch ($type)
			{
				case 1:
					$img_r = imagecreatefromgif($folder_name.$img);
					break;
				case 2:
					$img_r= imagecreatefromjpeg($folder_name.$img);
					break;
				case 3:
					$img_r = imagecreatefrompng($folder_name.$img);
					break;
			}
		return $img_r;
	}
function watermark_it($f_name,$watermark,$src_folder,$watermark_folder_path)
	{
/*
		For this to work these variables must be set prior to the calling statement being invoked.  It is recommended these not be
		set as ssession variables.
			$watermark_folder_path -  this is the folder where the watermark image to be used is located.  This is relative 
			to the site root and it must exist on the server.
			eg.
				$watermark_folder_path = "watermarks/";
			
			$watermark - this is the name of the watermark image to be used as a watermark.  It must exist in the above folder
			prior to running this function.
			eg.
				$watermark = "3creative_wm_large.png";
		$f_name is the image to be watermarked 
		$watermark is the image used as the watermark
		$src_folder is where the main image is located
		$watermark_folder_path is the path and folder to the watermark image (relative to the site root)
*/
		list($width,$height,$type,$attr)=getimagesize($src_folder.$f_name);
		list($wm_width,$wm_height,$wm_type,$wm_attr)=getimagesize($watermark_folder_path.$watermark);
		//Set an image mask to the size of the main image
		$temp_image_mask= imagecreatetruecolor($width,$height); 
		//Get the main image to be watermarked
		$main_image = get_the_image($f_name,$type,$src_folder);
		//Get the image to  be used as the watermark
		$w_mark = get_the_image($watermark,$wm_type,$watermark_folder_path);
		//Get the aspect rations for both the main image and the watermark image
		$ar = $width/$height;
		$war = $wm_width/$wm_height;
		//calculate the new sizes for the watermark, based on the size of the image to be watermarked.
		//This is done by first comparing the aspect ratios of the two in order to determine which dimension (width or height)
		//
		if ($war >= $ar)
			{
				//If the aspect ration of the watermark is greater than or equal to
				$wm_width_new = .8 * $width;
				$wm_height_new = $wm_width_new/$war;
			}
		else
			{
				$wm_height_new = .8 * $height;
				$wm_width_new = $wm_height_new*$war;
			}	
		//Put the watermark image in the work space
		$temp_image_mask_wm = imagecreatetruecolor($wm_width_new,$wm_height_new);
		imagecopyresampled($temp_image_mask_wm,$w_mark,0,0,0,0,$wm_width_new,$wm_height_new,$wm_width,$wm_height);
		imagecopyresampled($temp_image_mask,$main_image,0,0,0,0,$width,$height,$width,$height);
		//calculate the new x and y for the placement of the watermark (basically, center it )
		$dest_x = ($width - $wm_width_new)/2;
		$dest_y = ($height - $wm_height_new)/2;
		//merge the two images and place the watermarrk in the correct place.  Also set the alpha to 25
		//imagecopymerge($temp_image_mask,$w_mark,0,0,$dest_x,$dest_y,$wm_width,$wm_height,25);
		//get the transparent color from the watermark image i.e. the background
		//NOTE this anticipates there will be only background at the pixel location  1,1
		$rgb = imagecolorat($temp_image_mask_wm, 1,1);
		$r=($rgb>>16) & 0xFF;
		$g=($rgb>>8) & 0xFF;
		$b=$rgb & 0xFF;
		//use the color to transparent
		imagecolortransparent($temp_image_mask_wm, $rgb);		
		imagecopymerge($temp_image_mask,$temp_image_mask_wm,$dest_x,$dest_y,0,0,$wm_width_new,$wm_height_new,25);
		//imagejpeg($temp_image_mask, "images_made/".$thumb_file_name,60);
		imagejpeg($temp_image_mask, $src_folder.$f_name,50);
		imagedestroy($temp_image_mask);
		imagedestroy($temp_image_mask_wm);
		//return $f_name;
	}
?>