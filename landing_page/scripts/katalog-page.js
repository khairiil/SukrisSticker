document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const cards = document.querySelectorAll('.card');
    const noResultsMessage = document.getElementById('gaada');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        let matchFound = false;

        cards.forEach(card => {
            const cardTitle = card.querySelector('.card-name h2').textContent.toLowerCase();
            if (cardTitle.includes(searchTerm)) {
                card.style.display = 'flex'; 
                matchFound = true;
            } else {
                card.style.display = 'none'; 
            }
        });
        noResultsMessage.style.display = matchFound ? 'none' : 'block';
    });
});

function toggleMenu() {
    const navLinks = document.getElementById("navLinks");
    navLinks.classList.toggle("active");
};