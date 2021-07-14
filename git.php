<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Git Deploy</title>
</head>
<body>
    <h1>2 de Julho - BASE ATUALIZADA!!</h1>
    <pre>
    <?php
        $exec = shell_exec("cd /var/www/html/2dejulho && git pull origin master 2>&1");
        echo $exec;
    ?>
    </pre>
</body>
</html>
