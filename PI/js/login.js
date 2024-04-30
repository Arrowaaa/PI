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
