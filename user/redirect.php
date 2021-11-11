<?php
if (!isset($_COOKIE["redirect"])){
    header("Location: dashboard");
} else {
    header("Location: ".$_COOKIE["redirect"]);
}

?>