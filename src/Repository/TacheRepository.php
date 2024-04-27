<?php

namespace App\Repository;

use App\Entity\Tache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tache>
 *
 * @method Tache|null find($id_tache, $lockMode = null, $lockVersion = null)
 * @method Tache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tache[]    findAll()
 * @method Tache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheRepository extends ServiceEntityRepository

{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }
   // TacheRepository.php

// TacheRepository.php

// TacheRepository.php

// TacheRepository.php

//public function search($search, $id_projet = null)
//{
   /// $query = $this->createQueryBuilder('t')
      //            ->leftJoin('t.projet', 'p'); // Joindre avec la table Projet

    //if ($search) {
        //$query->andWhere('t.nom LIKE :search')
          //    ->setParameter('search', '%' . $search . '%');
    //}

    //if ($id_projet) {
      //  $query->andWhere('p.id_projet = :id_projet')
        //      ->setParameter('id_projet', $id_projet);
    //}

    //return $query->getQuery()->getResult();
}



//    /**
//     * @return Tache[] Returns an array of Tache objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tache
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

