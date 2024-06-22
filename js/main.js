document.getElementById('search').addEventListener('input', function() {
    const query = this.value.trim().toLowerCase();
    const blogCards = document.querySelectorAll('.grid > div');

    blogCards.forEach(card => {
        const title = card.querySelector('h2').innerText.toLowerCase();
        const isVisible = title.includes(query);

        if (isVisible) {
            card.classList.remove('hidden');
            card.classList.add('block');
        } else {
            card.classList.remove('block');
            card.classList.add('hidden');
        }
    });
});
