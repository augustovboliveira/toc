<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Cadastro</title>
<style>
.content {
     max-width: 615px;
     margin: auto;
}
h3, h2{
     font-family: "Arial Black";
     font-size: 29px;
}
.form-control {
     background-color: #e9e9e9;
     font-size: 20px;
     font-family: "Times";
}
</style>
</head>

<body>
<img src="../../public/assets/logo.png" alt="Logo do Site (TOC)" width=70 height=625 ALIGN=LEFT>
    
<div class="content">
<div class="centered-content">
    
     <form name="Cadastro" method="POST" action="//api/v1.php?apicall=poststudent">
     <br><br><br><br>

     <h2 style="text-align:center">CRIE SUA CONTA<br><br><br></h2>
     </div>

     <div class="mb-3">
     <input type="text" class="form-control" style=" background-color: #e9e9e9" name="nome" id="nome" placeholder="Nome:" ><br>


     <div class="mb-3">

     <input type="text" class="form-control" style=" background-color: #e9e9e9" name="email" id="email" placeholder="Email Institucional:" ><br>


     <div class="row">
     <div class="col">
     <input type="text" class="form-control" name="escola" id="escola" placeholder="Escola: " >
     </div>

     <div class="col">
     <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha: " aria-label="Senha: " >
     </div>

     <br><br><br><br>
        
     <div class="d-grid gap-2 d-md-block" style="text-align:center">
     <button style=" background-color: #054447; border-color: #054447; width: 280px" type="submit" name="btn-cadastrar" class="btn btn-primary btn-lg" ><h3>Cadastrar</h3></button>
     </div>

    </form>

</body>
</html>