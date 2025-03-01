function createParticle() {
    const particle = document.createElement('div');
    particle.className = 'particle';
    
    // Random position
    const x = Math.random() * window.innerWidth;
    particle.style.left = `${x}px`;
    
    // Random duration between 3-8 seconds
    const duration = 3 + Math.random() * 5;
    particle.style.setProperty('--duration', `${duration}s`);
    
    // Random opacity between 0.4-1
    const opacity = 0.4 + Math.random() * 0.6;
    particle.style.setProperty('--opacity', opacity);
    
    // Random size between 1-3px
    const size = 1 + Math.random() * 2;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    
    return particle;
}

function initParticles() {
    const container = document.createElement('div');
    container.className = 'particle-container';
    document.body.prepend(container);
    
    // Create initial particles
    for(let i = 0; i < 50; i++) {
        const particle = createParticle();
        container.appendChild(particle);
        
        // Remove particle after animation ends
        particle.addEventListener('animationend', () => {
            particle.remove();
        });
    }
    
    // Add new particles periodically
    setInterval(() => {
        if(container.children.length < 50) {
            const particle = createParticle();
            container.appendChild(particle);
            
            particle.addEventListener('animationend', () => {
                particle.remove();
            });
        }
    }, 200);
}

// Start when DOM is loaded
document.addEventListener('DOMContentLoaded', initParticles); 