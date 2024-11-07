<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/index.css">
    <title>Previsão do tempo</title>
</head>

<body>
    <div class="main">
        <h1>Previsão do Tempo</h1>
        <form action="../controller/c_validation.php" method="post">
            <legend>Localize a cidade</legend>
            <div class="searchCity">
                <p>Cidade:</p>
                <input type="text" value="" id="cidadescolhida" class="txt ac_input" size="36" autocomplete="off"
                    name="nomeCidade" required="">
            </div>

            <div class="searchUF">
                <p>UF:</p>
                <input type="text" value="" id="unidadefederal" class="txt input" size="36" autocomplete="off" name="uf"
                    required="" oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="btns">
                <a href="javascript:void(0);"
                    onclick="javascript:document.getElementById('cidadescolhida').value='';document.getElementById('cidadescolhida').focus();javascript:document.getElementById('unidadefederal').value='';">Redefinir</a>

                <input type="submit" value="Buscar" name="submit">
            </div>
        </form>
    </div>
    <?php
        include_once("footer.html");
    ?>
</body>

</html>