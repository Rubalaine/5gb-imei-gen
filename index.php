
<!
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Luis Magalhães JPG">
    <meta name="description" content="site voltado a geracao de imei para way de gigas da movitel">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerador de imei</title>
    <link rel="icon" href="logo3.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
</head>
<body>
    <div class="container is-fluid" style="margin-top: 24px">
        <div class="is-centered columns container has-text-centered">
            <div class="column is-one-third">
                <p class="title">Gerador de imeis de 5GB da Movitel</p>
                <p>Aplicacao feita exclusivamente para gerar imeis de 5 gbs da movitel, gera um imei por vez.</p>
                <p>se tentar 3 imeis consecutivos e nao funcionarem, entre em contacto para que eu resolva</p>
                <p>@Luis Magalhães JPG</p>
                <div class="field has-addons has-addons-centered">
                    <div class="control">
                        <a class="button is-info gerar" href="?clicou=true">
                            gerar
                        </a>
                    </div>
                    <?php if (isset($_GET['clicou'])): ?>
                    <?php
                    $imei = obterImei();?>
                    <div class="control">
                        <input type="text" class="input" id="valor" value="<?php echo $imei;?>" readonly>
                    </div>
                        <div class="control">
                            <button class="button copiar is-light" onclick="copyToClipboard()">copiar</button>
                        </div>
                    <?php
                    addImei($imei);?>
                    <?php else: ?>
                    <div class="control load">
                        <input type="text" class="input " placeholder="Nao foi gerado um imei" readonly>
                    </div>
                    <?php endif;?>
                    </div>
                <a class="button is-danger has-text-centered " href="index.php">Limpar</a>
                <div class="is-dark">
                    <br>
                    <p class="has-text-centered">imeis gerados: <?php echo getCOunt(); ?>+</p>
                </div>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.gerar').click(function () {
            $('.load').addClass('is-loading');
        });
    });
    function copyToClipboard() {
        let copyText = document.getElementById('valor');
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
    }
</script>
</body>
</html>
<?php
if (isset($_GET['mostrar'])){
    echo '<h1>'.obterImei().'</h1>';
}
function getCOunt(){
    $arq = fopen("contador.txt", "r");
    if (!$arq){
        echo 'erro ao abrir o arquivo';
    }
    if($cont = fscanf($arq, "%d")){
        $contN = $cont[0];
    }
    fclose($arq);
    return $contN;
}
function increaseCount($count){
    $count += 1;
    $arq = fopen("contador.txt", "w");
    if (!$arq){
        echo 'erro ao abrir o arquivo';
    }
    fprintf($arq, "%d", $count);
    fclose($arq);
}
function obterImei(){
    $arq = fopen("imei.txt", "r");
    if (!$arq){
        echo 'erro ao abrir o arquivo';
    }
    if($imei = fscanf($arq, "%d")){
        $imeiN = $imei[0];
    }
    fclose($arq);
    return $imeiN;
}
function addImei($imei){
    $imei += 10;
    $arq = fopen("imei.txt", "w");
    fprintf($arq, "%d", $imei);
    $count = getCOunt();
    increaseCount($count);
    fclose($arq);
}
?>