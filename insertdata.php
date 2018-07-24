<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['author']) && isset($_POST['title']) && isset($_POST['issue'])) {

    // receiving the post params
	$author = $_POST['author'];
	$title = $_POST['title'];
	$issue = $_POST['issue'];

	$post = $db->insertdata($author, $title, $issue);
	if ($post) {
		$response["error"] = FALSE;
		$response["id"] = $post["id"];
		$response["post"]["author"] = $post["author"];
		$response["post"]["title"] = $post["title"];
		$response["post"]["issue"] = $post["issue"];
		$response["post"]["created_at"] = $post["created_at"];
		echo json_encode($response);
	} else {
		$response["error"] = TRUE;
		$response["error_msg"] = "Unknown error occurred ";
		echo json_encode($response);
	}

} else {
	$response["error"] = TRUE;
	$response["error_msg"] = "Required parameters is missing!";
	echo json_encode($response);
}
?>

