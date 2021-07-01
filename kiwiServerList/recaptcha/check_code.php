<?php

	session_start();

	if (isset($_POST['submit'])) {

		$idServer = $_POST['submit'];
		$token = strtolower($_POST['token']);

		// validate captcha code
		if (isset($_SESSION['captcha_token']) && $_SESSION['captcha_token'] == $token) {

			header("Location: ../includes/vote.inc.php?id=" . $idServer);
			exit();

		} else {
			header("Location: ../serverInfo?id=" . $idServer . "&error=catpchaerror");
      exit();
		}

	}
?>
