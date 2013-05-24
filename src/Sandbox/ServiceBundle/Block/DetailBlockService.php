<?php
/**
 * This file is part of the Presta Bundle project.
 *
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sandbox\ServiceBundle\Block;

use Sonata\BlockBundle\Model\BlockInterface;

use Presta\CMSCoreBundle\Block\BaseModelBlockService;

/**
 * Block détail d'une référence
 *
 * @author David Epely <depely@prestaconcept.net>
 */
class DetailBlockService extends BaseModelBlockService
{
    /**
     * @var string
     */
    protected $settingsRoute = 'admin_sandbox_service_service_list';

    /**
     * @var string
     */
    protected $template = 'SandboxServiceBundle:Block:block_detail.html.twig';

    /**
     * @return Sandbox\ServiceBundle\Entity\Service\Repository
     */
    protected function getRepository()
    {
        return $this->container
                ->get('doctrine')
                ->getRepository('SandboxServiceBundle:Service');
    }

    /**
     * @param  \Sonata\BlockBundle\Model\BlockInterface $block
     * @return array
     */
    protected function getAdditionalViewParameters(BlockInterface $block)
    {
        $url = $this->container->get('request')->get('url');
        $service = $this->getRepository()->findOneBy(array('url' => $url));

        return array('service' => $service);
    }
}
