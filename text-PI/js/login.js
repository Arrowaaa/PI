document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evita o envio do formulário

        var username = document.getElementById("usuario").value;
        var password = document.getElementById("senha").value;

        if (username === "usuario" && password === "senha123") {
            alert("Login bem-sucedido!");
            window.location.href = "perfil.html"; // Redireciona para a nova página após o login
        } else {
            alert("Credenciais inválidas. Tente novamente.");
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const senhaInput = document.getElementById('senha');
    const mostrarSenhaBtn = document.getElementById('mostrarSenha');

    mostrarSenhaBtn.addEventListener('click', function () {
        senhaInput.type = senhaInput.type === 'password' ? 'text' : 'password';
        mostrarSenhaBtn.textContent = senhaInput.type === 'password' ? 'Mostrar Senha' : 'Ocultar Senha';
    });
});