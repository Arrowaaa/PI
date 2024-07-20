document.addEventListener("DOMContentLoaded", function() {
    const btnGenerate = document.querySelector("#generate-pdf");

    btnGenerate.addEventListener("click", () => {
        // Conteúdo do PDF
        const content = document.querySelector("#content");

        // Configuração do arquivo final de PDF
        const options = {
            margin: [10, 10, 10, 10],
            filename: "formulario.pdf",
            html2canvas: { scale: 2 },
            jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
        };

        // Gerar e baixar o PDF
        html2pdf().set(options).from(content).save().catch(err => console.error(err));
    });
});
