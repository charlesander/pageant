<?php

namespace App\Repository;

use App\Entity\OrganisationRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class OrganisationRoleRepository
 * @package App\Repository
 */
class OrganisationRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganisationRole::class);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function search(array $search)
    {
        $query = $this->createQueryBuilder('o');

        $query->andWhere('o.deleted = 0');

        if (isset($search['organisation_id'])) {
            $query->andWhere('o.organisation = :organisation_id')
                ->setParameter('organisation_id', (int)$search['organisation_id']);
        }

        if (isset($search['contact_id'])) {
            $query->andWhere('o.contact = :contact_id')
                ->setParameter('contact_id', (int)$search['contact_id']);
        }

        return $query->getQuery()
            ->getResult();
    }


    public function findOne($id): ?OrganisationRole
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.deleted = 0')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
