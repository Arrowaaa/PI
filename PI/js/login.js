document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita o envio do formulário

    var username = document.getElementById("Usuario").value;
    var password = document.getElementById("Senha").value;

    if (username === "usuario" && password === "senha123") {
        alert("Login bem-sucedido!");
        window.location.href = "nova_pagina.html"; // Redireciona para a nova página após o login
    } else {
        alert("Credenciais inválidas. Tente novamente.");
    }
});
