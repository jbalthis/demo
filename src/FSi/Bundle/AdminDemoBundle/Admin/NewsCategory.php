<?php

namespace FSi\Bundle\AdminDemoBundle\Admin;

use FSi\Bundle\AdminBundle\Doctrine\Admin\CRUDElement;
use FSi\Bundle\AdminSecurityBundle\Admin\SecuredElementInterface;
use FSi\Component\DataGrid\DataGridFactoryInterface;
use FSi\Component\DataSource\DataSourceFactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class NewsCategory extends CRUDElement implements SecuredElementInterface
{
    public function isAllowed(SecurityContextInterface $securityContext)
    {
        return $securityContext->isGranted('ROLE_ADMIN');
    }

    public function getId()
    {
        return 'news_category';
    }

    public function getName()
    {
        return 'demo.admin.news_category.name';
    }

    public function getClassName()
    {
        return 'FSi\Bundle\AdminDemoBundle\Entity\NewsCategory';
    }

    protected function initDataGrid(DataGridFactoryInterface $factory)
    {
        /* @var $datagrid \FSi\Component\DataGrid\DataGrid */
        $datagrid = $factory->createDataGrid('news_category');

        /*
        Looking for datagrid configuration?
        /src/FSi/Bundle/AdminDemoBundle/Resources/config/datagrid/news_category.yml

        $datagrid->addColumn('title', 'text', array(
            'label' => 'demo.admin.news_category.list.title',
            'editable' => true
        ));

        $datagrid->addColumn('actions', 'action', array(
            'label' => 'demo.admin.news.list.actions',
            'field_mapping' => array('id'),
            'actions' => array(
                'edit' => array(
                    'route_name' => 'fsi_admin_crud_edit',
                    'additional_parameters' => array('element' => $this->getId()),
                    'parameters_field_mapping' => array('id' => 'id')
                ),
            )
        ));
        */

        return $datagrid;
    }

    protected function initDataSource(DataSourceFactoryInterface $factory)
    {
        /* @var $datasource \FSi\Component\DataSource\DataSource */
        $datasource = $factory->createDataSource('doctrine', array(
            'entity' => $this->getClassName()
        ), 'news_category');

        /*
        Looking for datasource configuration?
        /src/FSi/Bundle/AdminDemoBundle/Resources/config/datasource/news_category.yml

        $datasource->addField('name', 'text', 'like', array(
            'sortable' => false,
            'form_options' => array(
                'label' => 'demo.admin.news.list.name',
            )
        ));
        */

        $datasource->setMaxResults(10);

        return $datasource;
    }

    protected function initForm(FormFactoryInterface $factory, $data = null)
    {
        $builder = $factory->createNamedBuilder('news_category', 'form', $data, array(
            'data_class' => $this->getClassName()
        ));

        $builder->add('name', 'text', array(
            'label' => 'demo.admin.news_category.list.name',
        ));
        $builder->add('description', 'fsi_ckeditor', array(
            'label' => 'demo.admin.news_category.form.description',
        ));

        return $builder->getForm();
    }
}
