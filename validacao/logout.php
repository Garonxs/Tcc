<?php

setcookie("usuario_logado", "false", [
        "path" => "/",
    ]);

header("Location: ..\\login.html");
