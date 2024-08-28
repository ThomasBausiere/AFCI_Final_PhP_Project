document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".btn");

    function hideAllSectionsAndRemoveActiveClass() {
        // Cache toutes les sections et retire la classe active de tous les boutons
        const sections = document.querySelectorAll(".content");
        sections.forEach(section => {
            section.classList.add('hidden');
            section.classList.remove('show');
        });

        buttons.forEach(button => {
            button.classList.remove('active');
        });
    }
    function showSectionAndSetActiveButton(sectionId, activeButton) {
        // Affiche la section correspondante et ajoute la classe active au bouton cliqué
        const section = document.getElementById(sectionId);
        if (section) {
            section.classList.remove('hidden');
            section.classList.add('show');
            activeButton.classList.add('active');
        }
    }
    buttons.forEach(button => {
        button.addEventListener("click", function() {
            hideAllSectionsAndRemoveActiveClass();
            const targetSection = button.getAttribute('data-target');
            showSectionAndSetActiveButton(targetSection, this); // 'this' fait référence au bouton cliqué
        });
    });
});