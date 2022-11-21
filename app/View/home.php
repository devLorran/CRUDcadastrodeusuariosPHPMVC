<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<style>
 #tabela{
    width: 75%;
 }
</style>
<body class="bg bg-dark text-light">

    <table id="tabela" class="table table-striped container">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuário</th>
                <th scope="col">Nome Usuário</th>
                <th scope="col">Senha</th>
                <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            {% for user in users %}
            <tr>
                <td>{{user.id}}</td>
                <td><a href="http://localhost/crudcadastrodeusuarios/?pagina=post&id={{user.id}}">{{user.user_name}}</a></td>
                <td>{{user.nome}}</td>
                <td>{{user.senha}}</td>
                <td><a class="btn btn-warning" href="http://localhost/crudcadastrodeusuarios/?pagina=create&metodo=change&id={{user.id}}">Editar</a> <a class="btn btn-danger" onclick="confirmarExclusao()">Deletar</a></td>
              </tr>
            {% endfor %}
          </tbody>
    </table>
    <script>
        function confirmarExclusao(){
            let id = <?php echo $_POST['id'] ?>;
            if (confirm("Você tem certeza de que deseja excluir o usuário" + id) == true) {
                document.location = "http://localhost/crudcadastrodeusuarios/?pagina=create&metodo=delete&id={{user.id}}";
            }else{
                document.location = "http://localhost/crudcadastrodeusuarios/";
            }
        }
    </script>
</body>
</html>