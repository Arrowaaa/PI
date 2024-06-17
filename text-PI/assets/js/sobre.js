const carousel = document.querySelector('.carousel');
const prevButton = carousel.querySelector('.prev');
const nextButton = carousel.querySelector('.next');
const imagesContainer = carousel.querySelector('.imagens-estrutura');
const totalImages = imagesContainer.querySelectorAll('img').length;
const imageWidth = 430; // Largura de cada imagem
const visibleImages = 2; // Número de imagens visíveis
let currentIndex = 0;

updateButtons(); // Chamada inicial para atualizar a visibilidade dos botões

nextButton.addEventListener('click', () => {
    if (currentIndex < totalImages - visibleImages) {
        currentIndex += 2; // Avança duas imagens de cada vez
        imagesContainer.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
        updateButtons();
    }
});

prevButton.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex -= 2; // Retrocede duas imagens de cada vez
        imagesContainer.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
        updateButtons();
    }
});

function updateButtons() {
    if (currentIndex >= totalImages - visibleImages) {
        nextButton.disabled = true; // Desabilita o botão "next" no final das imagens
    } else {
        nextButton.disabled = false; // Habilita o botão "next" se houver mais imagens para mostrar
    }

    if (currentIndex <= 0) {
        prevButton.disabled = true; // Desabilita o botão "prev" no início das imagens
    } else {
        prevButton.disabled = false; // Habilita o botão "prev" se houver imagens anteriores para mostrar
    }
}
