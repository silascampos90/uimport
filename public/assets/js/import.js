$(document).ready(function () {
    $('#fileUploadForm').ajaxForm({
        beforeSend: function () {
            var percentage = '0';
            $('#progressBar').show();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentage = percentComplete;
            $('.progress-bar').text(percentage + "%");
            $('.progress .progress-bar').css("width", percentage+'%', function() {               
              return $(this).attr("aria-valuenow", percentage) + "%";
            })
        },
        success: function (xhr) {
            console.log(xhr);
            showAlertSuccess();
            $('#progressBar').hide();
            console.log('File has uploaded');
        },
        error: function(xhr){
            console.log(xhr.responseJSON['message']);
            showAlertError(xhr.responseJSON['message']);
           }
    });
});

$( "input" ).focus(function() {
    $('.error').removeClass('error');
    $('#cepConsultaInput-error').hide();
});

function validarFormulario(form) {
    return $(`#${form}`).valid();
}

$('#consultaCepBtn').click(function (e) {
    e.preventDefault();

    if (validarFormulario('cepConsultaInput')) {
        var cep = $('#cepConsultaInput').val();
        $.ajax({
            method: 'get',
            url: $('#consultaCepRoute').val() + '/' + cep,
        }).fail(function (res) {

            showToaster('error', 'Erro', res.msg)

        }).done(function (res) {
           
            if(res.sucesso == true){                
                showToaster('success', 'Sucesso', res.msg)
                updateDados(res.data);
                addTableResult(res.data);
                $('#listEndereco').show();
            }else{
                showToaster('error', 'Erro', res.msg)
                $('#listEndereco').hide();
            }  

        });
    }
});


function addTableResult(dados){

    $('#trCidade').remove();
    $('#tbCidade').append(`<tr id="trCidade">
            <th id="dadoUF">${dados.uf}</th>
            <td>${dados.ddd}</td>
            <td id="dadoCidade">${dados.localidade}</td>
            <td>${dados.bairro}</td>
            <td>${dados.logradouro}</td>
        </tr>`);
}
function clearTableResult(){

    $('#tbCidade').append(``);
}


const endereco = {
    cep: null,
    logradouro: null,
    complemento: null,
    bairro: null,
    localidade: null,
    uf: null,
    ibge: null,
    gia: null,
    ddd: null,
    siafi: null
}

function updateDados(dados){
    endereco.cep = dados.cep;
    endereco.logradouro = dados.logradouro;
    endereco.complemento = dados.complemento;
    endereco.bairro = dados.bairro;
    endereco.localidade = dados.localidade;
    endereco.uf = dados.uf;
    endereco.ibge = dados.ibge;
    endereco.gia = dados.gia;
    endereco.ddd = dados.ddd;
    endereco.siafi = dados.siafi;
}


$('#cadastrarEndereco').click(function (e) {
    
    e.preventDefault();        
        
        $.ajax({
            method: 'post',
            url: $('#cadastraCepRoute').val(),
            data : endereco
        }).fail(function (res) {
            showToaster('error', 'Erro', res.msg)
        }).done(function (res) {
            $('#listEndereco').hide();
            if(res.sucesso == true){                
                showToaster('success', 'Sucesso', res.msg)
                addTableResult(res.data);
            }else{
                showToaster('error', 'Erro', res.msg)
            }  


        });

        $('#listEndereco').hide();
    
});





