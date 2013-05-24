<?php
/**
 * This file is part of the Presta CMS Sandbox project.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sandbox\ServiceBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Admin\Admin;

/**
 * @author David Epely <depely@prestaconcept.net>
 */
class ServiceAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('image', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
            ->addIdentifier('title')
            ->add('enabled')
        ;

        $listMapper
            ->add('_action', 'actions', array(
            'actions' => array(
                'edit' => array(),
                'delete' => array(),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with($this->trans('admin.form.fieldset.general'))
                ->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'reference')))
                ->add('title', 'text', array('required' => true, 'attr' => array('class' => 'sonata-medium locale')))
                ->add('url', 'text', array('required' => false, 'attr' => array('class' => 'sonata-medium')))
                ->add('description', 'textarea', array('required' => true, 'attr' => array('class' => 'sonata-medium locale')))
                ->add('enabled', null, array('required' => false))
            ->end();

        return;
    }
}
