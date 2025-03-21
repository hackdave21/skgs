// Écouteur d'événements pour détecter quand le DOM est chargé
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter des écouteurs d'événements à tous les liens de classe
    const classLinks = document.querySelectorAll('.btn-five');
    if (classLinks) {
        classLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                const schoolClassId = this.getAttribute('data-school-class-id');
                showTeacherSubjects(event, schoolClassId);
            });
        });
    }
});

function showTeacherSubjects(event, schoolClasseId) {
    event.preventDefault(); // Empêche le comportement par défaut
    console.log("Fonction showTeacherSubjects appelée pour la classe:", schoolClasseId);

    // Faire une requête AJAX pour récupérer les matières de l'enseignant pour cette classe
    fetch(`/teacher/subjects?school_class_id=${schoolClasseId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log("Données reçues:", data);
        // Créer un modal pour afficher les matières
        const subjectsModal = document.createElement('div');
        subjectsModal.className = 'modal subjects-modal';
        subjectsModal.style.display = 'block';
        subjectsModal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Vos matières pour la classe</h3>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    ${data.map(subject => `
                        <button class="subject-btn" data-school-class="${subject.school_classe_id}" data-subject="${subject.id}">
                            ${subject.name}
                        </button>
                    `).join('')}
                </div>
            </div>
        `;

        document.body.appendChild(subjectsModal);

        // Style du modal
        subjectsModal.style.position = 'fixed';
        subjectsModal.style.top = '50%';
        subjectsModal.style.left = '50%';
        subjectsModal.style.transform = 'translate(-50%, -50%)';
        subjectsModal.style.zIndex = '1000';
        subjectsModal.querySelector('.modal-content').style.backgroundColor = 'white';
        subjectsModal.querySelector('.modal-content').style.padding = '20px';
        subjectsModal.querySelector('.modal-content').style.borderRadius = '10px';
        subjectsModal.querySelector('.modal-content').style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';

        // Fermer le modal
        subjectsModal.querySelector('.close').onclick = () => subjectsModal.remove();

        // Fermer le modal en cliquant en dehors
        const closeOnOutsideClick = (e) => {
            if (!subjectsModal.querySelector('.modal-content').contains(e.target)) {
                subjectsModal.remove();
                document.removeEventListener('click', closeOnOutsideClick);
            }
        };

        // Ajouter l'écouteur après un court délai pour éviter qu'il se déclenche immédiatement
        setTimeout(() => {
            document.addEventListener('click', closeOnOutsideClick);
        }, 100);

        // Ajouter un événement pour chaque bouton de matière
        subjectsModal.querySelectorAll('.subject-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const schoolClassId = btn.dataset.schoolClass;
                const subjectId = btn.dataset.subject;
                showStudentsModal(schoolClassId, subjectId); // Afficher le modal des élèves
                subjectsModal.remove(); // Fermer le modal des matières
            });
        });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des matières:', error);
        alert('Erreur lors de la récupération des matières. Veuillez réessayer.');
    });
}

// Fonction pour afficher le modal des élèves
function showStudentsModal(schoolClassId, subjectId) {
    console.log("Affichage des élèves pour la classe", schoolClassId, "et la matière", subjectId);

    fetch(`/notes/${schoolClassId}/${subjectId}`, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log("Données des élèves reçues:", data);

        const studentsModal = document.createElement('div');
        studentsModal.className = 'modal students-modal';
        studentsModal.style.display = 'block';
        studentsModal.innerHTML = `
            <div class="modal-content" style="width: 80%; max-height: 80vh; overflow-y: auto;">
                <div class="modal-header">
                    <h3>Liste des élèves - ${data.subject.name}</h3>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <form id="gradesForm" method="POST" action="/notes/store">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="school_class_id" value="${schoolClassId}">
                        <input type="hidden" name="subject_id" value="${subjectId}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.students.map(student => `
                                    <tr>
                                        <td>${student.matricule}</td>
                                        <td>${student.last_name}</td>
                                        <td>${student.first_name}</td>
                                        <td>
                                            <input type="number" name="notes[${student.id}]"
                                                value="${data.grades[student.id]?.value || ''}"
                                                min="0" max="20" step="0.01" class="form-control"
                                                placeholder="Saisir la note">
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        `;

        document.body.appendChild(studentsModal);

        // Style du modal
        studentsModal.style.position = 'fixed';
        studentsModal.style.top = '50%';
        studentsModal.style.left = '50%';
        studentsModal.style.transform = 'translate(-50%, -50%)';
        studentsModal.style.zIndex = '1000';
        studentsModal.querySelector('.modal-content').style.backgroundColor = 'white';
        studentsModal.querySelector('.modal-content').style.padding = '20px';
        studentsModal.querySelector('.modal-content').style.borderRadius = '10px';
        studentsModal.querySelector('.modal-content').style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';

        // Fermer le modal
        studentsModal.querySelector('.close').onclick = () => studentsModal.remove();

        // Fermer le modal en cliquant en dehors
        const closeOnOutsideClick = (e) => {
            if (!studentsModal.querySelector('.modal-content').contains(e.target)) {
                studentsModal.remove();
                document.removeEventListener('click', closeOnOutsideClick);
            }
        };

        // Ajouter l'écouteur après un court délai pour éviter qu'il se déclenche immédiatement
        setTimeout(() => {
            document.addEventListener('click', closeOnOutsideClick);
        }, 100);

        // Gestion de la soumission du formulaire via AJAX
        studentsModal.querySelector('#gradesForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            fetch('/notes/store', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau: ' + response.status);
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    alert('Notes enregistrées avec succès');
                    studentsModal.remove();
                } else {
                    alert('Erreur lors de l\'enregistrement des notes: ' + (result.message || 'Erreur inconnue'));
                }
            })
            .catch(error => {
                console.error('Erreur lors de l\'enregistrement des notes:', error);
                alert('Erreur lors de l\'enregistrement des notes. Veuillez réessayer.');
            });
        });
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des élèves:', error);
        alert('Erreur lors de la récupération des élèves. Veuillez réessayer.');
    });
}
