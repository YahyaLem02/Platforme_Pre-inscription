document.addEventListener("DOMContentLoaded", function() {
    function translatePage() {
        const elements = document.querySelectorAll("[data-translate]");
        elements.forEach((element) => {
            const keys = element.getAttribute("data-translate").split(".");
            let text = lang;
            keys.forEach((key) => {
                text = text[key];
            });

            element.textContent = text;
        });
    }

    translatePage();

    function changeLanguage(newLang) {
        window.location.href = "../Translation/change_languageConnect.php?lang=" + newLang;
    }

    const englishButton = document.getElementById("englishButton");
    const frenchButton = document.getElementById("frenchButton");
    const arabicButton = document.getElementById("arabicButton");

    englishButton.addEventListener("click", function() {

        
        changeLanguage("english");
    });

    frenchButton.addEventListener("click", function() {
        changeLanguage("french");
    });

    arabicButton.addEventListener("click", function() {
        changeLanguage("arabic");
    });
});
