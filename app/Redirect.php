<?php

class Redirect {

	public static function redirect_to ($url) {
		header('Location:'. $url, true, 302);
        exit();
	}

}

?>