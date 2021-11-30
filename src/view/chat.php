<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script type="text/javascript">
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            //req.open('GET', '/current/api/v1.php?apicall=getarraymessage', true);
            req.open('GET', '/current/test/chat.php', true);
            req.send();
        }
        setInterval(function(){ajax();},1000);
    </script>
</head>
<body onload="ajax();">
    <div id="chat">

    </div>
    <br>
    <form method="POST" action="chat.php">
        <input type="hidden" name="id_remetente" id="id_remetente" value="1">
        <input type="hidden" name="id_sala" id="id_sala" value="1">
        <label for="conteudo">Digite sua mensagem:
        <input type="text" name="conteudo" id="conteudo">
        </label>
        <button type="submit">Enviar</button>
    </form>
    <?php
        $id_remetente;
        $id_sala;
        $conteudo;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_remetente = $_POST['id_remetente'];
            $id_sala = $_POST['id_sala'];
            $conteudo = $_POST['conteudo'];

            $url = 'http://localhost/current/api/v1.php?apicall=poststudent';
            $data = array('id_remetente' => $id_remetente, 'id_sala' => $id_sala, 'conteudo' => $conteudo);

            $options = array(
                'http' => array(
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if (!$result) { 
                echo "Things gone wrong";
                echo "<br><br><br>";
                var_dump($result);
            }
        }        

        
        
    ?>
</body>
</html>