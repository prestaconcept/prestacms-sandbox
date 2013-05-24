<?php
/**
 * This file is part of the Presta CMS Sandbox project.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sandbox\ServiceBundle\Entity\Service;

use Doctrine\ORM\EntityRepository;

/**
 * @author David Epely <depely@prestaconcept.net>
 */
class Repository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAllActive()
    {
        $qb = $this->createQueryBuilder('s')
                ->where('s.enabled = true')
                ->orderBy('s.position');

        return $qb->getQuery()->execute();
    }
}
