document.addEventListener("DOMContentLoaded", function () {
    var telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function (e) {
            var telefone = e.target.value;
            telefone = telefone.replace(/\D/g, '');
            if (telefone.length <= 11) {
                telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2');
                telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2');
                e.target.value = telefone;
            } else {
                e.target.value = e.target.value.slice(0, -1);
            }
        });
    }

    var contatoInput = document.getElementById('contato');
    if (contatoInput) {
        contatoInput.addEventListener('input', function (e) {
            var contato = e.target.value;
            contato = contato.replace(/\D/g, '');
            if (contato.length <= 11) {
                contato = contato.replace(/^(\d{2})(\d)/g, '($1) $2');
                contato = contato.replace(/(\d)(\d{4})$/, '$1-$2');
                e.target.value = contato;
            } else {
                e.target.value = e.target.value.slice(0, -1);
            }
        });
    }

    var CEPInput = document.getElementById('CEP');
    if (CEPInput) {
        CEPInput.addEventListener('input', function (e) {
            var CEP = e.target.value;
            CEP = CEP.replace(/\D/g, '');
            CEP = CEP.replace(/^(\d{5})(\d)/, '$1-$2');
            e.target.value = CEP;
        });
    }

    var cidadeInput = document.getElementById('cidade');
    if (cidadeInput) {
        cidadeInput.addEventListener('input', function (e) {
            var cidade = e.target.value;
            cidade = cidade.replace(/[^a-zA-Z\s]/g, '');
            e.target.value = cidade;
        });
    }

    var cpfInput = document.querySelector("#cpf");
    if (cpfInput) {
        cpfInput.addEventListener('input', function (e) {
            var cpf = e.target.value;
            cpf = cpf.replace(/\D/g, '');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = cpf;
        });
    }

    var nomeTutorInput = document.getElementById('nome');
    if (nomeTutorInput) {
        nomeTutorInput.addEventListener('input', function (e) {
            var nome = e.target.value;
            nome = nome.replace(/[^a-zA-Z\sç]/g, '');
            e.target.value = nome;
        });
    }

    var nomePetInput = document.getElementById('nomep');
    if (nomePetInput) {
        nomePetInput.addEventListener('input', function (e) {
            var nomep = e.target.value;
            nomep = nomep.replace(/[^a-zA-Z\sç]/g, '');
            e.target.value = nomep;
        });
    }

    const racaInput = document.getElementById('raca');
    if (racaInput) {
        racaInput.addEventListener('input', function (e) {
            let raca = e.target.value;
            raca = raca.replace(/[^a-zA-Z\s]/g, '');
            e.target.value = raca;
        });
    }

    // Validação do e-mail
    var emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('input', function (e) {
            var email = e.target.value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                emailInput.setCustomValidity("Por favor, insira um e-mail válido.");
            } else {
                emailInput.setCustomValidity("");
            }
        });
    }

    var peso = document.getElementById('peso');
    if (peso) {
        peso.addEventListener('input', function (e) {
            let value = parseFloat(e.target.value);
            if (isNaN(value)) {
                e.target.value = '';
            } else {
                if (value < 0) e.target.value = 0;
                if (value > 99) e.target.value = 99;
            }
        });
    }

});
