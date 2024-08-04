document.addEventListener("DOMContentLoaded", function () {
    var telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function (e) {
            var telefone = e.target.value;
            telefone = telefone.replace(/\D/g, '');
            telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2');
            telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2');
            e.target.value = telefone;
        });
    }

    var contatoInput = document.getElementById('contato');
    if (contatoInput) {
        contatoInput.addEventListener('input', function (e) {
            var contato = e.target.value;
            contato = contato.replace(/\D/g, '');
            contato = contato.replace(/^(\d{2})(\d)/g, '($1) $2');
            contato = contato.replace(/(\d)(\d{4})$/, '$1-$2');
            e.target.value = contato;
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
            cidade = cidade.replace(/[^a-zA-Z\s~]/gç, '');
            e.target.value = cidade;
        });
    }
    var cpfInput = document.getElementById('cpf');

    cpfInput.addEventListener('input', function (e) {
        var cpf = e.target.value;
        cpf = cpf.replace(/\D/g, '');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = cpf;
    });

    var nomeTutorInput = document.getElementById('nome');
    if (nomeTutorInput) {
        nomeTutorInput.addEventListener('input', function (e) {
            var nome = e.target.value;
            nome = nome.replace(/[^a-zA-Z\sç]/g, '');
            e.target.value = nome;
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var nomeTutorInput = document.getElementById('nome');

    nomeTutorInput.addEventListener('input', function (e) {
        var nome = e.target.value;
        nome = nome.replace(/[^a-zA-Z\sç]/g, '');
        e.target.value = nome;
    });
});

// document.addEventListener("DOMContentLoaded", function() {
//     var medicoInput = document.getElementById('medico');

//     medicoInput.addEventListener('input', function(e) {
//         var medico = e.target.value;
//         medico = medico.replace(/[^a-zA-Z\sç]/g, ''); 
//         e.target.value = medico;
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    var nomePetInput = document.getElementById('nomep');

    nomePetInput.addEventListener('input', function (e) {
        var nome = e.target.value;
        nome = nome.replace(/[^a-zA-Z\sç]/g, '');
        e.target.value = nome;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const cpfInput = document.getElementById('cpf');

    if (cpfInput) {
        cpfInput.addEventListener('input', function (e) {
            let cpf = e.target.value;
            cpf = cpf.replace(/\D/g, '');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = cpf;
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const racaInput = document.getElementById('raca');
    if (racaInput) {
        racaInput.addEventListener('input', function (e) {
            let raca = e.target.value;
            raca = raca.replace(/[^a-zA-Z\s]/g, '');
            e.target.value = raca;
        });
    }
});



//função para mostra o icone do olhinho

document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('#mostrarSenha');
    const password = document.querySelector('#senha');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('oculto');
    });

    const toggleConfirmPassword = document.querySelector('#mostrarConfirmSenha');
    const confirmPassword = document.querySelector('#confirmSenha');

    toggleConfirmPassword.addEventListener('click', function () {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('oculto');
    });
});



