
<?php

/**
 * Classe Bibliotheque : gere une collection de livres.
 */
class Bibliotheque
{
    /** @var Livre[] */
    private array $livres = [];

    /**
     * Ajoute un livre a la bibliotheque.
     * @throws Exception si le livre existe deja
     */
    public function ajouter(Livre $l): void
    {
        if ($this->trouver($l->getIsbn()) !== null) {
            throw new Exception("Un livre avec l'ISBN {$l->getIsbn()} existe deja.");
        }

        $this->livres[] = $l;
    }

    /**
     * Trouve un livre par son ISBN.
     */
    public function trouver(string $isbn): ?Livre
    {
        foreach ($this->livres as $livre) {
            if ($livre->getIsbn() === $isbn) {
                return $livre;
            }
        }

        return null;
    }

    /**
     * Retourne tous les livres.
     * @return Livre[]
     */
    public function tous(): array
    {
        return $this->livres;
    }

    /**
     * Compte le nombre total de livres.
     */
    public function compter(): int
    {
        return count($this->livres);
    }

    /**
     * Recherche des livres par titre ou auteur.
     * @return Livre[]
     */
    public function rechercher(string $mot): array
    {
        $resultats = [];

        foreach ($this->livres as $livre) {
            if (
                stripos($livre->getTitre(), $mot) !== false
                || stripos($livre->getAuteur(), $mot) !== false
            ) {
                $resultats[] = $livre;
            }
        }

        return $resultats;
    }

    /**
     * Calcule les statistiques du catalogue.
     */
    public function statistiques(): array
    {
        $total = $this->compter();
        $disponibles = 0;

        foreach ($this->livres as $livre) {
            if ($livre->estDisponible()) {
                $disponibles++;
            }
        }

        $empruntes = $total - $disponibles;

        $taux = $total > 0
            ? ($disponibles / $total) * 100
            : 0;

        return [
            'total' => $total,
            'disponibles' => $disponibles,
            'empruntes' => $empruntes,
            'taux_disponibilite' => $taux
        ];
    }
}
