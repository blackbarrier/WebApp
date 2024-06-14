<?php

namespace App\Repository;

use App\Entity\Turno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Turno>
 */
class TurnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Turno::class);
    }


    public function getTurnosDia($dia)
    {
        // Validar los parametros
        if (empty($dia)) {
            throw new \InvalidArgumentException('Search term cannot be empty.');
        };
        
        $entityManager = $this->getEntityManager(); 
        $query = $entityManager->createQuery(
            'SELECT t.fecha FROM App\Entity\Turno t
            WHERE t.fecha LIKE :dia'
        )
        ->setParameter('dia', '%'.$dia.'%')
        ;

        $resultado = $query->getResult();

        return $resultado;

    
        // try {
        //     $tur = 
        // } catch (\Doctrine\ORM\NoResultException $e) {
        //     // Handle cases where the query returns no results
        //     $agentes = [];
        // } catch (\Doctrine\ORM\ORMException $e) {
        //     // Handle cases where the query fails or returns an error
        //     throw new \RuntimeException('No se pudo traer agentes de la base de datos.', 0, $e);
        // }

        // Return the agents as an array
        
    }


//    /**
//     * @return Turno[] Returns an array of Turno objects
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

//    public function findOneBySomeField($value): ?Turno
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
