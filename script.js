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

document.querySelector('.contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const responseDiv = document.getElementById('response-message');
    
    fetch('process_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            responseDiv.textContent = '✓ Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.';
            responseDiv.style.color = '#28a745';
            responseDiv.style.display = 'block';
            document.querySelector('.contact-form').reset();
            setTimeout(() => {
                responseDiv.style.display = 'none';
            }, 5000);
        } else {
            responseDiv.textContent = '✗ Ошибка: ' + data.message;
            responseDiv.style.color = '#dc3545';
            responseDiv.style.display = 'block';
        }
    })
    .catch(error => {
        responseDiv.textContent = '✗ Произошла ошибка при отправке.';
        responseDiv.style.color = '#dc3545';
        responseDiv.style.display = 'block';
        console.error('Error:', error);
    });
});