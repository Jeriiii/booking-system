<?php

/* ochrana proti SQL injection */

function gpc_addslashes($str) {
    return (get_magic_quotes_gpc() ? $str : addslashes($str));
}

?>
