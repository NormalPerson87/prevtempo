<?php
session_start();
if (isset($_POST["submit"])) {
    $_SESSION['valid'] = true;
    $post_cidade = $_POST['nomeCidade'];
    $_SESSION['nome_cidade'] = $post_cidade;
    $_SESSION['uf'] = $_POST['uf'];
    $cidade_url = slugify($post_cidade);
    $url = 'http://servicos.cptec.inpe.br/XML/listaCidades?city=' . $cidade_url;
    $data = simplexml_load_file($url, 'SimpleXMLElement');

    foreach ($data->cidade as $cidade) {
        if ($_SESSION['nome_cidade'] == $cidade->nome && $_SESSION['uf'] == $cidade->uf) {
            $id_municipio = $cidade->id;
            $request_url = 'http://servicos.cptec.inpe.br/XML/cidade/7dias/' . $id_municipio . '/previsao.xml';
            $request_data = simplexml_load_file($request_url, 'SimpleXMLElement');
            $_SESSION['request_info'] = json_decode(json_encode($request_data), true);
            if ($_SESSION['valid'] == true) {
                header('Location: ../view/result.php');
                $verify = true;
                exit();
            }
        } else {
            $verify = false;
        }
    }
    if (!$verify) {
        echo "<script type='text/javascript'>  
                                alert('Erro ao procurar por cidade ou estado. Verifique se o nome da cidade está como pronome pessoal.');
                                window.location.href = '../view/index.php';
                                </script>";
    }



} else {
    echo "<script type='text/javascript'>  
                            alert('Erro.');
                           window.location.href = '../view/index.php';
                            </script>";
}

function slugify($text, $strict = false)
{
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);

    $text = trim($text, '-');
    setlocale(LC_CTYPE, 'en_GB.utf8');
    // transliterate
    if (function_exists('iconv')) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    // lowercase
    $text = strtolower($text);
    $text = preg_replace('~[^-\w.]+~', '', $text);
    $text = preg_replace('[-]', ' ', $text);
    if (empty($text)) {
        return 'empty_$';
    }
    if ($strict) {
        $text = str_replace(".", "_", $text);
    }
    return $text;
}