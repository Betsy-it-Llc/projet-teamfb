//code etape 2 creation de projet masquer demasque montant

// Vérifie si l'URL de la page contient "/utilisateur/pack/" suivi d'un nombre
if (!window.location.pathname.match(/\/utilisateur\/pack\/\d+/)) {
    // Code pour exécuter le script, sauf sur la page de détail du pack
    const button = document.querySelector("#menu-button"); // Hamburger Icon
    const menu = document.querySelector("#menu"); // Menu

    const checkBox = document.getElementById("checkBox");
    const montantToggle = document.getElementById("montantToggle");

    if (button) {
        button.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    }
    if (checkBox) {
        checkBox.addEventListener("change", function () {
            montantToggle.classList.toggle("hidden");
        });
    }
}


//script permetant de modifier le prix si on ajoute des personen ou des titres ( parcour achat detail pack )

document.addEventListener('DOMContentLoaded', function () {
    const nombrePersonnes = document.getElementById('nombre_personnes');
    const nombreTitres = document.getElementById('nombre_titres');
    const prixPackElement = document.getElementById('prix_pack');
    if (prixPackElement) {
        const prixPackInitial = parseFloat(prixPackElement.getAttribute('data-prix-initial'));
    }

    function updatePrixPack() {

        const personnes = parseInt(nombrePersonnes.value);
        const titres = parseInt(nombreTitres.value);

        if (personnes === 1 && titres === 1) {
            prixPackElement.textContent = `${prixPackInitial.toFixed(2)} €`;
        } else {
            const nouveauPrixPack = prixPackInitial + (40 * (personnes - 1)) + (85 * (titres -1));
            prixPackElement.textContent = `${nouveauPrixPack.toFixed(2)} €`;
        }
    }
if (nombrePersonnes) {
    nombrePersonnes.addEventListener('change', updatePrixPack);
    nombreTitres.addEventListener('change', updatePrixPack);

    updatePrixPack();
}


});



