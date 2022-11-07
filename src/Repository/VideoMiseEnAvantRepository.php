<?php

namespace App\Repository;

use App\Entity\VideoMiseEnAvant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VideoMiseEnAvant>
 *
 * @method VideoMiseEnAvant|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoMiseEnAvant|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoMiseEnAvant[]    findAll()
 * @method VideoMiseEnAvant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoMiseEnAvantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoMiseEnAvant::class);
    }

    public function save(VideoMiseEnAvant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VideoMiseEnAvant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VideoMiseEnAvant[] Returns an array of VideoMiseEnAvant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VideoMiseEnAvant
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
