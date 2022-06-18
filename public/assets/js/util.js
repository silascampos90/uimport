function showToaster(type, title, msg, options) {
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-bottom-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    if (options !== undefined) {
        Object.keys(options).forEach(function (item) {
            if (options[item] !== null && options[item] !== undefined) {
                toastr.options[item] = options[item];
            }
        });
    }

    if (type == "success") toastr.success(msg, title);
    else if (type == "error") toastr.error(msg, title);
    else if ((type = "warning")) toastr.warning(msg, title);
    else toastr.info(msg, title);
}



function showAlertSuccess() {
	Swal.fire(
		'Ótimo!',
		'Arquivo enviado com sucesso!',
		'success'
	  )
}

function showAlertError(message) {
	Swal.fire(
		'Erro!',
		message,
		'error'
	  )
}

function showAlertErrorFormat() {
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: 'O Arquivo está em um formato diferente do padrão',
		footer: '<a href="">Desaja baixar o arquivo padrão?</a>'
	  })
}

function showAlert(title, msg, icon) {
	Swal.fire(title,msg,icon)
}
