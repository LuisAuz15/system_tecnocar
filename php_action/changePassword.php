<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = md5($_POST['password']);
	$newPassword = md5($_POST['npassword']);
	$conformPassword = md5($_POST['cpassword']);
	$userId = $_POST['user_id'];

	$sql ="SELECT * FROM users WHERE user_id = {$userId}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE users SET password = '$newPassword' WHERE user_id = {$userId}";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Actualizado de manera satisfactoria";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Ocurrió un error mientras se actualizaba la información";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "La nueva contraseña no coincide con la confirmación de contraseña. Revise";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "La contraseña actual es incorrecta";
	}

	$connect->close();

	echo json_encode($valid);

}

?>