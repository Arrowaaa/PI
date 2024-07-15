
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
// Função do botão com a setinha da tela de perfil
function toggleDropdown() {
    var oculto = document.getElementById("oculto");
    if (oculto.style.display === "none") {
        oculto.style.display = "block";
    } else {
        oculto.style.display = "none";
    }
}
