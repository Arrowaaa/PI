document.addEventListener("DOMContentLoaded", function() {
    var telefoneInput = document.getElementById('telefone');
    
    telefoneInput.addEventListener('input', function(e) {
        var telefone = e.target.value;
        telefone = telefone.replace(/\D/g, ''); // Remove caracteres não numéricos
        telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2'); // Adiciona parênteses no DDD
        telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2'); // Adiciona hífen entre os últimos 4 dígitos
        e.target.value = telefone;
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var contatoInput = document.getElementById('contato');
    
    contatoInput.addEventListener('input', function(e) {
        var contato = e.target.value;
        contato = contato.replace(/\D/g, ''); 
        contato = contato.replace(/^(\d{2})(\d)/g, '($1) $2'); 
        contato = contato.replace(/(\d)(\d{4})$/, '$1-$2'); 
        e.target.value = contato;
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var nomeTutorInput = document.getElementById('nomeTutor');
    
    nomeTutorInput.addEventListener('input', function(e) {
        var nome = e.target.value;
        nome = nome.replace(/[^a-zA-Z\sç]/g, ''); // Remove caracteres não alfabéticos exceto espaços
        e.target.value = nome;
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var medicoInput = document.getElementById('medico');
    
    medicoInput.addEventListener('input', function(e) {
        var medico = e.target.value;
        medico = medico.replace(/[^a-zA-Z\sç]/g, ''); // Remove caracteres não alfabéticos exceto espaços
        e.target.value = medico;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var nomePetInput = document.getElementById('nomePet');
    
    nomePetInput.addEventListener('input', function(e) {
        var nome = e.target.value;
        nome = nome.replace(/[^a-zA-Z\sç]/g, ''); 
        e.target.value = nome;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var cpfInput = document.getElementById('cpf');
    
    cpfInput.addEventListener('input', function(e) {
        var cpf = e.target.value;
        cpf = cpf.replace(/\D/g, ''); 
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 
        e.target.value = cpf;
    });
});

// document.addEventListener("DOMContentLoaded", function() {
//     var crmInput = document.getElementById('crm');
    
//     crmInput.addEventListener('input', function(e) {
//         var crm = e.target.value;
//         crm = crm.replace(/(\d{3})(\d)/, '$1.$2'); 
//         crm = crm.replace(/[^a-zA-Z\sç]/g, ''); 
//         e.target.value = cpf;
//     });
// });

