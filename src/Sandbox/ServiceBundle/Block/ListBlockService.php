<?php
/**
 * This file is part of the Presta CMS Sandbox project.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sandbox\ServiceBundle\Block;

use Sonata\BlockBundle\Model\BlockInterface;

use Presta\CMSCoreBundle\Block\BaseModelBlockService;

/**
 * Block that list services
 *
 * @author David Epely <depely@prestaconcept.net>
 */
class ListBlockService extends BaseModelBlockService
{
    /**
     * @var string
     */
    protected $settingsRoute = 'admin_sandbox_service_service_list';

    /**
     * @var string
     */
    protected $template = 'SandboxServiceBundle:Block:block_list.html.twig';

    /**
     * @param  \Sonata\BlockBundle\Model\BlockInterface $block
     * @return array
     */
    protected function getAdditionalViewParameters(BlockInterface $block)
    {
        $services = $this->getRepository()->findAllActive();

        return array('services' => $services);
    }

    /**
     * @return Sandbox\ServiceBundle\Entity\Service\Repository
     */
    protected function getRepository()
    {
        return $this->container
                ->get('doctrine')
                ->getRepository('SandboxServiceBundle:Service');
    }
}
