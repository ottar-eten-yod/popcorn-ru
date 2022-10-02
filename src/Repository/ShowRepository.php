<?php

namespace App\Repository;

use App\Entity\Show;
use App\Repository\Locale\BaseLocaleRepository;
use App\Service\Search\SearchInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Show|null find($id, $lockMode = null, $lockVersion = null)
 * @method Show|null findOneBy(array $criteria, array $orderBy = null)
 * @method Show[]    findAll()
 * @method Show[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowRepository extends MediaRepository
{
    public function __construct(SearchInterface $search, ManagerRegistry $registry)
    {
        parent::__construct($search, $registry, Show::class);
    }

    public function findOrCreateShowByImdb(string $imdbId): Show
    {
        $movie = $this->findByImdb($imdbId);
        if (!$movie) {
            $movie = new Show();
            $movie->setImdb($imdbId);
            $this->_em->persist($movie);
        }

        return $movie;
    }
}
