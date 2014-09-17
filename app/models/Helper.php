<?php

class Helper {

    public static function slugify($str) {
		// replace non letter or digits by -
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );

		if (empty($str))
		{
			return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		}
		   
		return $str;
	}

	public static function uploadImage($image, $type = 'upload', $name , $user_id){

		$upload_folder = '/var/www/datas/laravel/public/uploads/user/'.$user_id. '/';

		if($type == 'url'){
			try{
				$getimage = getimagesize($image);
			}catch(ErrorException $e){
				return array( false , 'Wrong file provided (either too big or not valid image)');
			}
		}else{
			$getimage = true;
		}
		if ( $getimage ){

			// if the folder doesn't exist then create it.
			if (!file_exists($upload_folder)) {
				mkdir($upload_folder, 0775, true);
			}
			
			if (!file_exists($upload_folder . 'or/')) {
				mkdir($upload_folder. 'or/', 0775, true);
			}
			
			if (!file_exists($upload_folder . 'thumb/')) {
				mkdir($upload_folder. 'thumb/', 0775, true);
			}

			if($type =='upload'){

				//$filename =  $image->getClientOriginalName();

				// if the file exists give it a unique name
				//while (file_exists($upload_folder.$filename)) {
				//	$filename =  uniqid() . '-' . $filename;
				//}
				$extension = '.png';


				$filename = $name . $extension;

				$uploadSuccess = $image->move($upload_folder, $filename);

				//if(strpos($filename, '.gif') > 0){
				//	$new_filename = str_replace('.gif', '-animation.gif', $filename);
				//	copy($upload_folder . $filename, $upload_folder . $new_filename);
				//}

			} else if($type = 'url'){
				
				$file = file_get_contents($image);

				$extension = '.png';


				$filename = $name . $extension;

			    file_put_contents($upload_folder.$filename, $file);

			}
		   
			$img = Image::make($upload_folder . $filename);
			$img->resize(700, null, function ($constraint) {
							$constraint->aspectRatio();
						});
			$img->save($upload_folder . 'or/' . $filename);
			
			$img = Image::make($upload_folder . $filename);
			$img->resize(150, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save($upload_folder . 'thumb/' . $filename);
			unlink($upload_folder.$filename);
			return array( true , '');

		} else {
			return array( false , 'Wrong file provided (either too big or not valid image)');
		}
	}

}