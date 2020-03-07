<?php

namespace TGWF\Greencheck\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TGWF\Greencheck\Entity\GreencheckTld;

/**
 * GreencheckAsRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GreencheckTldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GreencheckTld::class);
    }

    /**
     * Get all domain tld's we have data for.
     *
     * @return string
     */
    public function getTLDsWithData()
    {
        $result = $this->findBy([]);
        $domains = [];
        foreach ($result as $tld) {
            if ($tld->getGreenDomains() > 5) {
                $domain = strtolower($tld->getToplevel());
                $domains[$domain] = $domain;
            }
        }

        return $domains;
    }

    public function getOrdered()
    {
        $where = $this->select()->order('checked_domains DESC');

        return $this->fetchAll($where);
    }

    public function getPercentage()
    {
        $query = 'SELECT green_domains/checked_domains*100 as perc,COUNT(*) as count FROM `greencheck_tld`';

        return $this->getAdapter()->fetchRow($query);
    }
}
