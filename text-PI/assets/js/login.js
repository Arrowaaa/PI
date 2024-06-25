// document.addEventListener("DOMContentLoaded", function() {
//     document.getElementById("loginForm").addEventListener("submit", function(event) {
//         event.preventDefault(); // Evita o envio do formulário

//         var username = document.getElementById("usuario").value;
//         var password = document.getElementById("senha").value;

//         if (username === "arrow" && password === "Aluno123") {
//             alert("Login bem-sucedido!");
//             window.location.href = "perfil.html"; // Faz a Referencia para a nova página após o login
//         } else {
//             alert("Credenciais inválidas. Tente novamente.");
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#mostrarSenha');
    const password = document.querySelector('#senha');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('oculto');
    });

    const toggleConfirmPassword = document.querySelector('#mostrarConfirmSenha');
    const confirmPassword = document.querySelector('#confirmSenha');

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('oculto');
    });
});


// função do botão com a setinha da tela de perfil
        function toggleDropdown() {
            var oculto = document.getElementById("oculto");
            if (oculto.style.display === "none") {
                oculto.style.display = "block";
            } else {
                oculto.style.display = "none";
            }
        }