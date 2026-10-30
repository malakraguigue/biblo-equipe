
 
// Tests : statistiques du catalogue

// Test : bibliotheque vide
$bibVide = new Bibliotheque();
$statsVides = $bibVide->statistiques();

verifier($statsVides['total'] === 0, 'Statistiques : bibliotheque vide - total 0');
verifier($statsVides['disponibles'] === 0, 'Statistiques : bibliotheque vide - 0 disponible');
verifier($statsVides['empruntes'] === 0, 'Statistiques : bibliotheque vide - 0 emprunte');
verifier($statsVides['taux_disponibilite'] == 0, 'Statistiques : bibliotheque vide - taux 0%');

// Test : 4 livres disponibles
$stats = $bib->statistiques();

verifier($stats['total'] === 4, 'Statistiques : total de 4 livres');
verifier($stats['disponibles'] === 4, 'Statistiques : 4 livres disponibles');
verifier($stats['empruntes'] === 0, 'Statistiques : aucun livre emprunte');
verifier($stats['taux_disponibilite'] == 100, 'Statistiques : taux de disponibilite 100%');

// Test : emprunter un livre
$l1->emprunter();
$stats = $bib->statistiques();

verifier($stats['total'] === 4, 'Statistiques : total inchange apres emprunt');
verifier($stats['disponibles'] === 3, 'Statistiques : 3 livres disponibles apres emprunt');
verifier($stats['empruntes'] === 1, 'Statistiques : 1 livre emprunte');
verifier($stats['taux_disponibilite'] == 75, 'Statistiques : taux de disponibilite 75%');

// Test : rendre le livre emprunte
$l1->rendre();
$stats = $bib->statistiques();

verifier($stats['disponibles'] === 4, 'Statistiques : 4 disponibles apres retour');
verifier($stats['empruntes'] === 0, 'Statistiques : aucun emprunt apres retour');
verifier($stats['taux_disponibilite'] == 100, 'Statistiques : taux 100% apres retour');
