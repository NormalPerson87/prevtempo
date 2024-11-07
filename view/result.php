<?php header("Content-Type: text/html; charset=utf-8");
include_once "../controller/c_sessao.php";
require_once "../controller/decodeTempo.php";
$nome_cidade = $_SESSION['nome_cidade'];
$uf = $_SESSION['uf']; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="icon" type="image/x-icon" href="img/icons8-rain-32.png">
    <script src="js/result.js" defer></script>
    <link rel="stylesheet" href="css/result.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Previsão de 7 dias</title>
</head>

<body>
    <div class="header">
        <div class="link">
            <a href="../index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z" />
                </svg>Retornar</a>
        </div>
        <div class="title">
            <?php
            echo "<h1>" . $nome_cidade . "-" . $uf . "</h1>";
            ?>
        </div>
    </div>
    <div class="main">
        <div class="title_main">
            <h2>Previsão de 4 dias</h2>
        </div>
        <div class="btns">
            <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
        </div>
        <?php
        if (isset($_SESSION['request_info']) && $_SESSION['request_info'] != null) {
            $info = $_SESSION['request_info'];

            foreach ($info['previsao'] as $previsao) {
                $resultado = decode($previsao['tempo']);
                echo "<div class='mySlides'><p class='dia'>Dia: " . $previsao['dia'] . "</p>";
                echo "<p class= 'svg_icon'>" . $resultado['icon'] . "</p><br>";
                echo "<div class='caract'><p class='tempo'>Tempo: " . $resultado['desc'] . "</p>";
                echo "<p class='temp max'>Temp. Máxima: " . $previsao['maxima'] . "°C</p>";
                echo "<p class='temp min'>Temp. Mínima: " . $previsao['minima'] . "°C</p>";
                echo "<p class='uv'>Índice de UV: " . $previsao['iuv'] . "%</p></div></div>";
            }
        }
        ?>
    </div>
    <?php
        include_once("footer.html");
    ?>
</body>

</html>