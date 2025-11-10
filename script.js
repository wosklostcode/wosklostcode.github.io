const cards = document.querySelectorAll('.graytag, .tag, .tag2, .logo, .tabletka3, .tabletka2, .card img');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.09)'; 
            this.style.transition = 'transform 0.3s ease'; 
            this.style.cursor = 'default'; 
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)'; 
            this.style.boxShadow = 'none'; 
        });
    });
