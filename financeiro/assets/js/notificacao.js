function ValidarCadastroJS() {

    if (document.getElementById('nome').val() === "") {
        alert("Por favor, preencha o campo NOME!")
        $("#nome").focus();
        $("#nomes").addClass('has-error');
        return false;
        
    } else if ($("#nome").val().length < 3) {
        alert("O campo NOME deve conter no mínimo 3 caracteres!");
        $("#nome").focus();
        $("#nomes").addClass('has-error');
        return false;
        
    } else {
        $("#nomes").removeClass('has-error').addClass('has-success');
    }
    
    if ($("#email").val().trim() == '') {
        alert("Por favor, preencha o campo EMAIL!");
        $("#email").focus();
        $("#emails").addClass('has-error');
        return false;
        
    } else {
        $("#emails").removeClass('has-error').addClass('has-success');
    }
    
    if ($("#senha").val().trim() == '') {
        alert("Por favor, preencha o campo SENHA");
        $("#senha").focus();
        $("#senhas").addClass('has-error');
        return false;

    } else if($("#senha").val().length < 6) {
        alert("A SENHA deve conter no mínimo 6 caracteres!")
        $("#senhas").addClass('has-error');
        
        return false;
    } else {
        $("#senhas").removeClass('has-error').addClass('has-success');
    }
    
    if ($("#rsenha").val().trim() == '') {
        alert("Por favor, preencha o campo REPETIR SENHA");
        $("#rsenha").focus();
        $("#password").addClass('has-error');
        
        return false;
        
    } else if($("#rsenha").val() != $("#senha").val()){
        alert("As senhas nos campos SENHA e REPETIR SENHA devem ser iguais!");
        $("#rsenha").focus();
        $("#password").addClass('has-error');
        return false;
    } else {
        $("#password").removeClass('has-error').addClass('has-success');
    }
}

function ValidarLoginJS(){
    if($("#email").val().trim() == ""){
        alert("Por favor, preencha o campo EMAIL!")
        $("#email").focus();
        $("#emails").addClass('has-error')

        return false;
    }else{
        $("#emails").removeClass('has-error').addClass('has-success');
    }
    
    if($("#password").val().trim() == ""){
        alert("Por favor, preencha o campo SENHA!")
        $("#password").focus();
        $("#senha").addClass('has-error')

        return false;
    }else{
        $("#password").removeClass('has-error').addClass('has-success');
    }
}

function ValidarMeusDadosJS() {

    if ($("#nome").val().trim() == '') {
        alert("Por favor, preencha o campo NOME!")
        $("#nome").focus();
        $("#nomes").addClass('has-error');
        
        return false;
        
    } else if ($("#nome").val().length < 3) {
        alert("O campo NOME deve conter no mínimo 3 caracteres!");
        $("#nome").focus();
        $("#nomes").addClass('has-error');
        return false;
        
    } else {
        $("#nomes").removeClass('has-error').addClass('has-success');
    }
    
    if ($("#email").val().trim() == '') {
        alert("Por favor, preencha o campo EMAIL");
        $("#email").focus();
        $("#emails").addClass('has-error');
        return false;
    } else {
        $("#emails").removeClass('has-error').addClass('has-success');
    }
    
}

function ValidarNovaCategoriaJS() {
    
    if ($("#nomeCategoria").val().trim() == '') {
        alert("Por favor, preencha o campo NOME DA CATEGORIA!")
        $("#nomeCategoria").focus();
        $("#nomeC").addClass('has-error');
        
        return false;
        
    } else {
        $("#nomeC").addClass('has-success');
    }
}

function ValidarAlterarCategoriaJS() {

    if ($("#nomeCategoria").val().trim() == '') {
        alert("Por favor, preencha o campo NOME DA CATEGORIA!")
        $("#nomeCategoria").focus();
        $("#nomeC").addClass('has-error');
        

        return false;
        
    } else {
        $("#nomeC").addClass('has-success');
    }

}

function ValidarNovaEmpresaJS() {

    if ($("#nomeEmpresa").val().trim() == '') {
        alert("Por favor, preencha o campo NOME DA EMPRESA!")
        $("#nomeEmpresa").focus();
        $("#nomes").addClass('has-error');

        return false;

    } else {
        $("#nomes").removeClass('has-error').addClass('has-success');
    }

}

function ValidarAlterarEmpresaJS(){

    if ($("#nomeEmpresa").val().trim() == '') {
        alert("Por favor, preencha o campo NOME DA EMPRESA!")
        $("#nomeEmpresa").focus();
        $("#nomes").addClass('has-error');

        return false;

    } else {
        $("#nomes").removeClass('has-error').addClass('has-success');
    }

    
}

function ValidarNovaContaJS(){

    if ($("#nomeBanco").val().trim() == '') {
        alert("Por favor, preencha o campo NOME DO BANCO!")
        $("#nomeBanco").focus();
        $("#nomeB").addClass('has-error');

        return false;

    } else {
        $("#nomeB").removeClass('has-error').addClass('has-success');
    }

    if ($("#agencia").val().trim() == '') {
        alert("Por favor, preencha o campo AGÊNCIA!");
        $("#agencia").focus();
        $("#agen").addClass('has-error');

        return false;
    } else {
        $("#agen").removeClass('has-error').addClass('has-success');
    }

    if ($("#numConta").val().trim() == '') {
        alert("Por favor, preencha o campo NÚMERO DA CONTA!");
        $("#numConta").focus();
        $("#num").addClass('has-error');

        return false;
    } else {
        $("#num").removeClass('has-error').addClass('has-success');
    }

    if($("#saldo").val().trim() == ''){
        alert("Por favor, preencha o campo SALDO!");
        $("#saldo").focus();
        $("#saldos").addClass("has-error");

        return false;
    } else {
        $("#saldos").removeClass("has-error").addClass("has-success")
    }

}

function ValidarAlteraContaJS(){

    if ($("#nomeBanco").val().trim() == '') {
        alert("Por favor, preencha o campo NOME DO BANCO!")
        $("#nomeBanco").focus();
        $("#nomeB").addClass('has-error');

        return false;

    } else {
        $("#nomeB").removeClass('has-error').addClass('has-success');
    }

    if ($("#agencia").val().trim() == '') {
        alert("Por favor, preencha o campo AGÊNCIA!");
        $("#agencia").focus();
        $("#agen").addClass('has-error');

        return false;
    } else {
        $("#agen").removeClass('has-error').addClass('has-success');
    }

    if ($("#numConta").val().trim() == '') {
        alert("Por favor, preencha o campo NÚMERO DA CONTA!");
        $("#numConta").focus();
        $("#num").addClass('has-error');

        return false;
    } else {
        $("#num").removeClass('has-error').addClass('has-success');
    }

    if($("#saldo").val().trim() == ''){
        alert("Por favor, preencha o campo SALDO DA CONTA!");
        $("#saldo").focus();
        $("#saldos").addClass('has-error');

        return false;
    } else {
        $("#saldos").removeClass('has-error').addClass('has-success')
    }

}

function ValidarRealizarMovimentoJS(){

    if ($("#tipo").val().trim() == '') {
        alert("Por favor, selecione o tipo do MOVIMENTO!")
        $("#tipo").focus();
        $("#tipoM").addClass('has-error');

        return false;

    } else {
        $("#tipoM").removeClass('has-error').addClass('has-success');
    }

    if ($("#data").val().trim() == '') {
        alert("Por favor, preencha o campo DATA DO MOVIMENTO");
        $("#data").focus();
        $("#dataM").addClass('has-error');

        return false;
    } else {
        $("#dataM").removeClass('has-error').addClass('has-success');
    }

    if ($("#categoria").val().trim() == '') {
        alert("Por favor, selecione uma CATEGORIA!");
        $("#categoria").focus();
        $("#categorias").addClass('has-error');

        return false;
    } else {
        $("#categorias").removeClass('has-error').addClass('has-success');
    } 

    if ($("#empresa").val().trim() == '') {
        alert("Por favor, selecione uma EMPRESA!");
        $("#empresa").focus();
        $("#empresas").addClass('has-error');

        return false;
    } else {
        $("#empresas").removeClass('has-error').addClass('has-success');
    }

    if ($("#conta").val().trim() == '') {
        alert("Por favor, selecione uma CONTA!");
        $("#conta").focus();
        $("#contas").addClass('has-error');

        return false;
    } else {
        $("#contas").removeClass('has-error').addClass('has-success');
    }

    if($("#valor").val().trim() == ''){
        alert("Por favor, preencha o campo VALOR DO MOVIMENTO!");
        $('#valor').focus();
        $("#value").addClass('has-error');
        return false;
    } else {
        $("#value").removeClass('has-error').addClass('has-success');
    }

}

function ValidarConsultarMovimentoJS(){
    
    if ($("#data").val().trim() == '') {
        alert("Por favor, preencha o campo DATA INICIAL!")
        $("#data").focus();
        $("#dataI").addClass('has-error');

        return false;

    } else {
        $("#dataI").removeClass('has-error').addClass ('has-success');
    }

    if ($("#dataF").val().trim() == '') {
        alert("Por favor, preencha o campo DATA FINAL!")
        $("#dataF").focus();
        $("#dateF").addClass('has-error');

        return false;

    } else {
        $("#dateF").removeClass('has-error').addClass('has-success');
    }

}



