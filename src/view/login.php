<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do usuario</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<style>

h5{
     font-family: "Arial Black";
     font-size: 29px;
}
</style>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   

<div class="container">
<div class="centered-content">

    
    <form method = "POST" action = "/current/api/v1.php?apicall=loginvalidacao">

    <center><br><br><br><br>
    <img src="bob.png" alt="Logo do Site (TOC)" width=150 height=150>
    <h5>LOGIN
    </h5>
    </center>
    <br>
    

    <input type="text" class="form-control" style=" background-color: #e9e9e9" name="email" id="email" placeholder="Insira seu email:" ><br>
        
    <input type="text" class="form-control" style=" background-color: #e9e9e9" name="senha" id="senha" placeholder="Insira sua senha:" ><br>
        
        <a class="waves-effect waves-light btn-large" type="submit" value="entrar" id="entrar">Entrar</a>
        
        <a href="cadastro.php" class="waves-effect waves-light btn-large">Crie Sua Conta</a>
        <br>
    
</form>


</body>
</html>