document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('#mostrarSenha');
    const password = document.querySelector('#senha');

    if (togglePassword && password) {
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('oculto');
        });
    }

    const toggleConfirmPassword = document.querySelector('#mostrarConfirmSenha');
    const confirmPassword = document.querySelector('#confirmSenha');

    if (toggleConfirmPassword && confirmPassword) {
        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('oculto');
        });
    }
    // const form = document.querySelector('#loginForm');
    // form.addEventListener('submit', function (event) {
    //     const emailInput = document.querySelector('#email'); // Validação do email
    //     const senhaInput = document.querySelector('#senha'); // Validação da senha

    //     // Validação do email
    //     const email = emailInput.value.trim();
    //     if (!isValidEmail(email)) {
    //         alert('Por favor, insira um endereço de email válido.');
    //         emailInput.focus();
    //         event.preventDefault();
    //         return;
    //     }

    //     // Validação da senha
    //     const senha = senhaInput.value.trim();
    //     if (senha.length < 6) {
    //         alert('A senha deve ter pelo menos 6 caracteres.');
    //         senhaInput.focus();
    //         event.preventDefault();
    //         return;
    //     }
    // });

    // function isValidEmail(email) {
    //     const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //     return regex.test(email);
    // }
});

// Função do botão com a setinha da tela de perfil
function toggleDropdown() {
    var oculto = document.getElementById("oculto");
    oculto.classList.toggle("bnt_oculto");
}

document.addEventListener('DOMContentLoaded', function() {
    // Função para a foto do usuário no perfil
    const inputFoto = document.getElementById('input-foto');
    if (inputFoto) {
        inputFoto.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgUsuario = document.getElementById('img-usuario');
                if (imgUsuario) {
                    imgUsuario.setAttribute('src', e.target.result);
                }
            }

            reader.readAsDataURL(file);
        });
    }

    const imgUsuario = document.getElementById('img-usuario');
    if (imgUsuario) {
        imgUsuario.addEventListener('click', function() {
            const inputFoto = document.getElementById('input-foto');
            if (inputFoto) {
                inputFoto.click();
            }
        });
    }   
});

// Função para abrir o seletor de arquivo ao clicar na foto
document.addEventListener('DOMContentLoaded', function() {
    const editarFoto = document.getElementById('editar-foto');
    const imgUsuario = document.getElementById('img-usuario');
    const dropdownFoto = document.querySelector('.dropdown-foto');
    const inputFoto = document.getElementById('foto');
    const enviarFoto = document.getElementById('enviar-foto');

    if (editarFoto && imgUsuario && dropdownFoto && inputFoto && enviarFoto) {
        // Mostrar o dropdown ao clicar na foto
        imgUsuario.addEventListener('click', function() {
            dropdownFoto.classList.toggle('show');
        });

        // Atualizar a foto do usuário ao selecionar um novo arquivo
        inputFoto.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                imgUsuario.setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(file);
        });

    
        enviarFoto.addEventListener('click', function() {
            // Aqui você pode adicionar a lógica para enviar a foto para o servidor, se necessário
            alert('Foto enviada!');
        });
    }
});
