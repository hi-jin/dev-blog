<?php
	session_start();
    $_SESSION['user_name'] = "guest";
    $_SESSION['user_id'] = "guest";
    $_SESSION['is_admin'] = 0;
?>
<script>location.href='/index.php'</script>