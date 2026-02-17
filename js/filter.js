 // Filtro de categoria por pills
    document.querySelectorAll('.cat-pill').forEach(pill => {
        pill.addEventListener('click', e => {
            e.preventDefault();
            document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            const cat = pill.dataset.cat;
            document.querySelectorAll('.post-box').forEach(card => {
                if (cat === 'todos' || card.dataset.cat === cat) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });