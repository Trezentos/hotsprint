<?php
$formatos = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0)
{
	require_once __DIR__ . '/../config.php';

	$tempFile 		= $_FILES['file']['tmp_name'];
	$id 			= $db->escape($_POST['id']);
	$categoria 		= $_POST['categoria'];
	$tabela 		= strtoupper($_POST['tabela']);
	$tabela_img 	= strtoupper($_POST['tabela_img']);
	$TAM 			= 1500;
	$permalink 		= PREFIX_NAME_IMG;



	# SET PREFIX NAME
	$existColumnPermalink = $db->query("SHOW COLUMNS FROM ".$tables[$tabela]." LIKE 'permalink'");

	if( $existColumnPermalink )
	{
		$permalink = $db->get_var("SELECT permalink FROM ".$tables[$tabela]." WHERE id='{$id}'");
	}



	$upload_temp = upload('file',TEMP,MAX_SIZE);

	if($upload_temp[0] == 'true')
	{
		require PHP . 'classes/Class.imagem.php';

		$extensao = pathinfo($upload_temp[1], PATHINFO_EXTENSION);
		
		if( !in_array(strtolower($extensao), $formatos) ) {
			@unlink(TEMP.$upload_temp[1]);
			echo json_encode(['status' => 'error']);
			exit;
		}

		if ($extensao == 'jpeg') $extensao = "jpg";


		$fileName 	 = $upload_temp[1];
		$fileNewName = $permalink.'-'.$id.'-'.rand(0,999);

		list($width, $height) = getimagesize(TEMP.$fileName);

		
		switch ($categoria)
		{
			case 'galeria' :
				$wTb  = 640;
				$hTb  = 500;

				// $wMd  = 1920;
				// $hMd  = 760;
			break;

			case 'obras' :
				$TAM  = 1300;

				$wTb  = 710;
				$hTb  = 420;
			break;

			default : 
				$wTb  = 300;
				$hTb  = 300;
			break;
		}


		if($height > $width) {
			$new_width	= $TAM;
			$new_height = ($TAM * $height)/$width;
		} else {
			$new_height	= ($height / $width) * $TAM;
			$new_width	= $TAM;
		}



		# LARGE - CREATE WEBP
		$image = new Image(TEMP.$fileName);
		$image->setPathToTempFiles(TEMP);
		$image->resize($new_width, $new_height, "fit", "c", "t", 80, "webp");
		$image->save(ROOT_UPLOADS_IMG.'lg-'.$fileNewName,"","webp");


		# SAVE JPG / PNG FOR OLD BROWSER
		$image->resize($new_width, $new_height, "fit", "c", "t");
		$image->save(ROOT_UPLOADS_IMG.'lg-'.$fileNewName,"",$extensao); 




		if( isset($wMd) && isset($hMd) )
		{	
			# MED - CREATE WEBP
			$imgMd = new Image(TEMP.$fileName);
			$imgMd->setPathToTempFiles(TEMP);
			$imgMd->resize($wMd, $hMd, "crop", "c", "c", 80, "webp");
			$imgMd->save(ROOT_UPLOADS_IMG.'md-'.$fileNewName,"","webp");


			# SAVE JPG / PNG FOR OLD BROWSER
			$imgMd->resize($wMd, $hMd, "crop", "c", "c");
			$imgMd->save(ROOT_UPLOADS_IMG.'md-'.$fileNewName);
		}




		# THUMB - CREATE WEBP
		$imgTb = new Image(TEMP.$fileName);
		$imgTb->setPathToTempFiles(TEMP);
		$imgTb->resize($wTb, $hTb, "crop", "c", "c", 80, "webp");
		$imgTb->save(ROOT_UPLOADS_IMG.'tb-'.$fileNewName,"","webp");


		# SAVE JPG / PNG FOR OLD BROWSER
		$imgTb->resize($wTb, $hTb, "crop", "c", "c");
		$imgTb->save(ROOT_UPLOADS_IMG.'tb-'.$fileNewName); 



		$fileNewName = $fileNewName.".".$extensao;
		
		$db->insert($tables[$tabela_img], ['id_galeria'=>$id, 'arquivo'=>$fileNewName, 'categoria'=>$categoria]);
		$query = $db->get_row("SELECT id FROM ".$tables[$tabela_img]." WHERE arquivo='{$fileNewName}' LIMIT 1");
		@unlink(TEMP.$fileName);
				
		echo json_encode([
			"status" 	 => "success",
			"id" 		 => $query->id,
			"id_galeria" => $id,
			"nome" 		 => $fileNewName,
			"categoria"  => $categoria,
			"tabela" 	 => strtolower($tabela),
			"tabela_img" => $tabela_img,
		]);

		exit;

	} else {
		@unlink(TEMP.$upload_temp[1]);
		echo json_encode(['status' => 'error']);
		exit;
	}
}

echo json_encode(['status' => 'error']);
exit;