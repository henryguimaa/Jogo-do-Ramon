document.addEventListener("DOMContentLoaded", () => {

    const lines = document.querySelectorAll(".cena");
    const nextBtn = document.getElementById("nextBtn");

    let index = 0;

    function mostrarLinha() {
        if (index >= lines.length) {
            nextBtn.classList.remove("hidden");
            return;
        }

        let linha = lines[index];
        let texto = linha.getAttribute("data-line");
        linha.style.opacity = 1;

        let i = 0;
        let speed = 35;

        function typeWriter() {
            if (i < texto.length) {
                linha.textContent += texto.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            } else {
                index++;
                setTimeout(mostrarLinha, 800);
            }
        }

        typeWriter();
    }

    setTimeout(mostrarLinha, 1500);

});