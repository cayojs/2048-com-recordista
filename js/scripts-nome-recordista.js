$(document).ready(function(){

    $("#formulario_recordista").validate({
        rules:{nome_recordista:{required: true, maxlength: 25}},

        messages:{nome_recordista:{required: "Campo obrigatório.", maxlength: "Limite de 25 caracteres."}},

        submitHandler: function (form) {

            var formulario = $("#formulario_recordista");
            var informacao = {"nome_recordista": formulario.find('[name=nome_recordista]').val()};
            $.ajax({
                url: 'https://www.cayojs.com.br/testes/2048/cadastra-nome-recordista.php',
                type: 'POST',
                data: informacao,
                accept: 'application/json',
                success: function(){
                    window.location.href = "https://www.cayojs.com.br/testes/2048/sucesso.php";
                },
                error: function(){
                    alert('Erro ao Cadastrar o Nome.');
                }
            });
            return false;

        }
    });

});