<?php

namespace TGWF\Greencheck\Repository;


/**
 * GreencheckAsRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
interface GreencheckTldRepositoryInterface
{
    /**
     * Get all domain tld's we have data for.
     */
    public function getTLDsWithData(): array;
}