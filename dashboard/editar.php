<?php

if(isset($_POST['editar_usuario']) && ($_POST['editar_usuario']=='form1')){
    require_once '../class/DAO/Usuarios.php';
    require_once '../class/entidades/Usuarios.class.php';

    $usuarioDAO = new UsuarioDAO;
    $usuario = new Usuarios;

    $id = $_POST['usu_id'];
    $nome = $_POST['usu_nome'];
    $login = $_POST['usu_login'];
    

    $usuario->setNome($nome);
    $usuario->setLogin($login);
    $usuario->setId($id);

    $usuarioDAO->editarUsuario($usuario);

}elseif (isset($_POST['editar-associado']) && ($_POST['editar-associado']=='form1')) {
    require_once '../class/DAO/Associados.php';
    require_once '../class/entidades/Associados.class.php';

    $associadoDAO = new AssociadosDAO;
    $associado = new Associados;

    $id = $_POST['ass_id'];
    $nome = $_POST['ass_nome'];
    $cpf = $_POST['ass_cpf'];
    $data = $_POST['ass_data_nasc'];
    $profissao = $_POST['ass_prof'];
    $endereco = $_POST['ass_end'];
    $cep = $_POST['ass_cep'];
    $telefone = $_POST['ass_tel'];
    $email = $_POST['ass_email'];
    $pagamento = $_POST['ass_paga'];
    $status = $_POST['ass_status'];
   

    $associado->setId($id);
    $associado->setNome($nome);
    $associado->setCpf($cpf);
    $associado->setData_nasc($data);
    $associado->setProfissao($profissao);
    $associado->setEndereco($endereco);
    $associado->setCep($cep);
    $associado->setTelefone($telefone);
    $associado->setEmail($email);
    $associado->setPagamento($pagamento);
    $associado->setStatus($status);

    $associadoDAO->editarAssociado($associado);
    

}elseif (isset($_POST['editar-noticia']) && ($_POST['editar-noticia']=='form1')){
    $upload_error_codes=array("",
		"The uploaded file exceeds the upload_max_filesize directive in php.ini.","",
		"The uploaded file was only partially uploaded.",
		"No file was uploaded.","Missing a temporary folder.",
		"Failed to write file to disk.","File upload stopped by extension.");
	$allowed_ext_string="jpg,jpeg,png,gif,bmp,tif";
	$allowed_extensions=explode(",",$allowed_ext_string);
	$upload_status = "";
	$allowed_size =  6+0;
	$success_page = "";
	$thumbs_dir = "";
	$resize_image = "yes";
	$resize_width = 900+0;
	$resize_height = +0;
	$thumb_width = +0;
	$thumb_height = +0;		
	$make_thumbs = "";
	$thumb_prefix = "";
	$thumb_suffix = "";
	$file_prefix = "";
	$file_suffix = "";
	$append_date_stamp = "1";
	$date_stamp=($append_date_stamp=="1")?date(time()):"";
	$haulted = false;
	$upload_folder="../upload/img-noticias/";
	//Check for restrictions
	//Check if upload folder exists
	if(!file_exists($upload_folder)){die("Upload folder doesn't exist");}
	if(!is_writable($upload_folder)){die("Upload folder is not writable");}
	if($make_thumbs == "yes" && !file_exists($thumbs_dir)){die("Thumbnails folder doesn't exist");}
	if($make_thumbs == "yes" && !is_writable($thumbs_dir)){die("Thumbnails folder is not writable");}
	foreach($_FILES as $files => $_file){
		//Check if it's not empty
		if($_file['name']!=""){
			$pathinfo = pathinfo($_file['name']);
			//If allowed extension or no extension restriction
			if(!in_array(strtolower($pathinfo['extension']),$allowed_extensions) && $allowed_ext_string!=""){
				die(strtoupper($pathinfo['extension'])." files are not allowed.
				<br>No files have been uploaded.");
			}
			if($_file['size']>$allowed_size*1048576 && $allowed_size!=0){
				die("The file size of ".basename($_file['name'])." is ".round($_file['size']/1048576,2)."MB,
				which is larger than allowed ".$allowed_size."MB.<br>No files have been uploaded.");
			}		
		}
	}
	//All checks passed, attempt to upload
	foreach($_FILES as $files => $_file){
		//Check if it's not empty
		if($_file['name']!=""){
			$pathinfo = pathinfo($_file['name']);
			$file_name_array = explode(".", basename($_file['name']));
			$filename = $file_name_array[count($file_name_array)-2];
			$target = $upload_folder;
			$file_uploaded = false;
			$target = $target."/".$file_prefix.$filename.$file_suffix.$date_stamp.".".$pathinfo['extension'];
			//if image
			if(strtolower($pathinfo['extension'])=="jpeg" || strtolower($pathinfo['extension'])=="jpg"){
				//if needs resizing or a thumbnail
				if(($resize_image == "yes" && ($resize_width!="" || $resize_height!="")) || ($make_thumbs == "yes" && ($thumb_width!="" || $thumb_height!=""))){
					$src = imagecreatefromjpeg($_file['tmp_name']);
					list($width,$height)=getimagesize($_file['tmp_name']);
					//if needs thumbnail
					if ($make_thumbs == "yes" && ($thumb_width!="" || $thumb_height!="")){
						$thumb_newwidth=($thumb_width!=0)?$thumb_width:(($width/$height)*$thumb_height);
						$thumb_newheight=($thumb_height!=0)?$thumb_height:(($height/$width)*$thumb_width);
						$tmp=imagecreatetruecolor($thumb_newwidth,$thumb_newheight);
						imagecopyresampled($tmp,$src,0,0,0,0,$thumb_newwidth,$thumb_newheight,$width,$height);
						$thumb_name=$thumb_prefix.$filename.$thumb_suffix.$date_stamp.".".$pathinfo['extension'];
						if(imagejpeg($tmp,$thumbs_dir."/".$thumb_name,100)){
							$upload_status=$upload_status."Thumbnail for ".basename($_file['name'])." was created successfully.<br>";
						}else{
							die($upload_status."There was a problem creating a thumbnail for ". basename($_file['name']).".
							Upload was interrupted.<br>");
						}
					}
					//if needs resizing
					if($resize_image == "yes" && ($resize_width!="" || $resize_height!="")){
						$newwidth=($resize_width!=0)?$resize_width:(($width/$height)*$resize_height);
						$newheight=($resize_height!=0)?$resize_height:(($height/$width)*$resize_width);
						$tmp=imagecreatetruecolor($newwidth,$newheight);
						imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); 
						if(imagejpeg($tmp,$target,100)){
							$upload_status=$upload_status.basename($_file['name'])." was successfully resized.<br>";
							$file_uploaded=true;
						}else{
							die($upload_status.basename($_file['name'])." could not be resized. Upload was interrupted.<br>");
						}
					}
				}
			}
			if(!$file_uploaded){
				if(move_uploaded_file($_file['tmp_name'], $target)){
					$upload_status=$upload_status.basename($_file['name'])." was uploaded successfully.<br>";
				}else{
					$haulted=true;
				}
			}
			//Cleanup
			if(isset($src)){imagedestroy($src);unset($src);}
			if(isset($tmp)){imagedestroy($tmp);unset($tmp);}
			if($haulted){die($upload_status."There was a problem uploading ". basename($_file['name']).".
						Error: ".$upload_error_codes[basename($_file['error'])].". Upload was interrupted.<br>");}
		}
	}
	if($success_page!="" && $upload_status!=""){
		header("Location: ".$success_page);
    }
    
    foreach($_FILES as $files => $_file){
        $_POST[$files]=""; 
        if($_file['name']!=""){
        $pathinfo=pathinfo($_file['name']);
        $file_name_array = explode(".", basename($_file['name']));
        $filename = $file_name_array[count($file_name_array)-2]; 
        $_POST[$files]=$file_prefix.$filename.$file_suffix.$date_stamp.".".$pathinfo['extension']; 
        }
        }
        

    require_once '../class/DAO/Noticias.php';
    require_once '../class/entidades/Noticias.class.php';

    $noticiasDAO = new NoticiasDAO;
    $noticia = new Noticia;

    $id = $_POST['not_id'];
    $foto = $_POST['not_foto'];

    $noticia->setId($id);
    $noticia->setFoto($foto);

    $noticiasDAO->editarFoto($noticia);

}elseif (isset($_POST['editar-noticia']) && ($_POST['editar-noticia']=='form2')){
    require_once '../class/DAO/Noticias.php';
    require_once '../class/entidades/Noticias.class.php';

    $noticiasDAO = new NoticiasDAO;
    $noticia = new Noticia;

    $id = $_POST['not_id'];
    $titulo = $_POST['not_titulo'];
    $texto = $_POST['not_texto'];
    $data = $_POST['not_data'];
    $status = $_POST['not_status'];

    $noticia->setId($id);
    $noticia->setTitulo($titulo);
    $noticia->setTexto($texto);
    if($data != NULL){
        $noticia->setData($data);
    }else{
        $noticia->setData(date('Y-m-d'));
    }
    $noticia->setStatus($status);

    $noticiasDAO->editaNoticia($noticia);
    
}elseif (isset($_POST['editar-helper']) && ($_POST['editar-helper']=='form1')){
	require_once '../class/DAO/Helpers.php';
	require_once '../class/entidades/Helpers.class.php';
	
	$helpersDAO = new HelpersDAO;
	$helper = new Helpers;

	$id = $_POST['help_id'];
	$nome = $_POST['help_nome'];
	$telefone = $_POST['help_fone'];
	$email = $_POST['help_email'];
	$localizacao = $_POST['help_loc'];
	$dias = $_POST['help_dias'];
	$hora = $_POST['help_hora'];
	$turma = $_POST['help_turma'];
	$periodicidade = $_POST['help_period'];

	$helper->setId($id);
	$helper->setNome($nome);
	$helper->setTelefone($telefone);
	$helper->setEmail($email);
	$helper->setLocalizacao($localizacao);
	$helper->setDias($dias);
	$helper->setHora($hora);
	$helper->setTurma($turma);
	$helper->setPeriodicidade($periodicidade);

	$helpersDAO->editarHelper($helper);

}elseif (isset($_POST['editar-evento']) && ($_POST['editar-evento']=='form1')){
	require_once '../class/DAO/Eventos.php';
	require_once '../class/entidades/Eventos.class.php';

	$eventosDAO = new EventosDAO;
	$evento = new Eventos;

	$id = $_POST['eve_id'];
	$titulo = $_POST['eve_titulo'];
	if(isset($_POST['eve_data'])&& $_POST['eve_data']!=''){
		$data = $_POST['eve_data'];
	}else{
		$data = $_POST['eve_data_alter'];
	}
	if(isset($_POST['eve_hora'])&& $_POST['eve_hora']!=''){
		$hora = $_POST['eve_hora'];
	}else{
		$hora = $_POST['eve_hora_alter'];
	}
	
	$participantes = $_POST['eve_participa'];
	$contato = $_POST['eve_contato'];
	$local = $_POST['eve_local'];

	$evento->setId($id);
	$evento->setTitulo($titulo);
	$evento->setData($data);
	$evento->setHora($hora);
	$evento->setParticipantes($participantes);
	$evento->setContato($contato);
	$evento->setLocal($local);

	$eventosDAO->editarEvento($evento);
	
}elseif (isset($_POST['editar-recado']) && ($_POST['editar-recado']=='form1')){
	require_once '../class/DAO/Guia.php';
	require_once '../class/entidades/Guia.class.php';

	$guiaDAO = new GuiaDAO;
	$recado = new Guia;
	
	$id = $_POST['guia_id'];
	$mensagem = $_POST['guia_msg'];

	$recado->setId($id);
	$recado->setMensagem($mensagem);

	$guiaDAO->editaRecado($recado);


}elseif (isset($_POST['editar-palestra']) && ($_POST['editar-palestra']=='form1')){
	require_once '../class/DAO/Palestras.php';
	require_once '../class/entidades/Palestras.class.php';

	$palestraDAO = new PalestrasDAO;
	$palestra = new Palestras;

	$id = $_POST['pal_id'];
	$numero = $_POST['pal_numero'];
	$nome = $_POST['pal_nome'];
	$descricao = $_POST['pal_desc'];

	$palestra->setId($id);
	$palestra->setNumero($numero);
	$palestra->setNome($nome);
	$palestra->setDescricao($descricao);

	$palestraDAO->editarPalestra($palestra);

}else {
    echo "erro!";
}



?>