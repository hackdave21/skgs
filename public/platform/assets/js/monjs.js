function showTeacherSubjects(event) {
    event.preventDefault(); // Empêcher le comportement par défaut du lien

    // Faire une requête AJAX pour récupérer les matières
    fetch('/teacher/subjects')
        .then(response => response.json())
        .then(data => {
            // Créer une carte dynamique
            const card = document.createElement('div');
            card.className = 'subjects-card';
            card.innerHTML = `
                <div class="card-header">
                    <h3>Vos matières</h3>
                </div>
                <div class="card-body">
                    ${data.map(subject => `
                        <a href="/notes/${subject.school_class_id}/${subject.id}" class="subject-btn">
                            ${subject.name}
                        </a>
                    `).join('')}
                </div>
            `;

            // Ajouter la carte à la page
            document.body.appendChild(card);

            // Style de la carte (optionnel)
            card.style.position = 'fixed';
            card.style.top = '50%';
            card.style.left = '50%';
            card.style.transform = 'translate(-50%, -50%)';
            card.style.backgroundColor = 'white';
            card.style.padding = '20px';
            card.style.borderRadius = '10px';
            card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            card.style.zIndex = '1000';

            // Fermer la carte en cliquant à l'extérieur
            document.addEventListener('click', function (e) {
                if (!card.contains(e.target)) {
                    card.remove();
                }
            });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des matières:', error);
        });
}
