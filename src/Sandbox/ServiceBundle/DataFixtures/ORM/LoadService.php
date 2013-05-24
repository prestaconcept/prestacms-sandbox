<?php
/**
 * This file is part of the Presta Bundle project.
 *
 * @author     Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sandbox\ServiceBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Application\Sonata\MediaBundle\Entity\Media;

use Sandbox\ServiceBundle\Entity\Service;

/**
 * Load Fixtures
 */
class LoadService extends AbstractFixture implements FixtureInterface
{
    /**
     * Création des pages de contenu
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $service = new Service();
            $service->setTitle('Service ' . $i);

            if ($i%2 == 0) {
                $service->setTitle($faker->sentence(3));
            }

            $service->setDescription($faker->text);
            $service->setEnabled(true);
            $service->setUrl(urlencode($i . '-' . $service->getTitle()));

            if ($i%3 == 0) {
                $service->setEnabled(false);
            }

            $media = $manager->merge($this->getReference('media-' . rand(1, 30)));

            if ($media) {
                $service->setImage($media);
            }

            $manager->persist($service);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
