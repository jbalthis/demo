<?php

namespace FSi\Bundle\AdminDemoBundle\Admin;

use FSi\Bundle\AdminBundle\Admin\Doctrine\CRUDElement;
use FSi\Component\DataGrid\DataGridFactoryInterface;
use FSi\Component\DataSource\DataSourceFactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;

class News extends CRUDElement
{
    public function getId()
    {
        return 'news';
    }

    public function getName()
    {
        return 'demo.admin.news.name';
    }

    public function getClassName()
    {
        return 'FSi\Bundle\AdminDemoBundle\Entity\News';
    }

    protected function initDataGrid(DataGridFactoryInterface $factory)
    {
        /* @var $datagrid \FSi\Component\DataGrid\DataGrid */
        $datagrid = $factory->createDataGrid('news');

        /*
        Looking for datagrid configuration?
        /src/FSi/Bundle/AdminDemoBundle/Resources/config/datagrid/news.yml

        $datagrid->addColumn('title', 'text', array(
            'label' => 'demo.admin.news.list.title',
            'editable' => true
        ));
        $datagrid->addColumn('created_at', 'datetime', array(
            'label' => 'demo.admin.news.list.created_at'
        ));
        $datagrid->addColumn('visible', 'boolean', array(
            'label' => 'demo.admin.news.list.visible'
        ));
        $datagrid->addColumn('creator_email', 'text', array(
            'label' => 'demo.admin.news.list.creator_email'
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
        ), 'news');

        /*
        Looking for datasource configuration?
        /src/FSi/Bundle/AdminDemoBundle/Resources/config/datasource/news.yml

        $datasource->addField('title', 'text', 'like', array(
            'sortable' => false,
            'form_options' => array(
                'label' => 'demo.admin.news.list.title',
            )
        ));
        $datasource->addField('created_at', 'date', 'between', array(
            'field' => 'createdAt',
            'sortable' => true,
            'form_options' => array(
                'label' => 'demo.admin.news.list.created_at'
            ),
            'form_from_options' => array(
                'widget' => 'single_text',
                'label' => false,
            ),
            'form_to_options' => array(
                'widget' => 'single_text',
                'label' => 'demo.admin.news.list.created_at_to',
            )
        ));
        $datasource->addField('visible', 'boolean', 'eq', array(
            'sortable' => false,
            'form_options' => array(
                'label' => 'demo.admin.news.list.visible',
            )
        ));
        */

        $datasource->setMaxResults(10);

        return $datasource;
    }

    protected function initForm(FormFactoryInterface $factory, $data = null)
    {

        $builder = $factory->createNamedBuilder('news', 'form', $data, array(
            'data_class' => $this->getClassName()
        ));

        $builder->add('title', 'text', array(
            'label' => 'demo.admin.news.list.title',
        ));
        $builder->add('photo', 'fsi_file', array(
            'label' => 'demo.admin.news.form.photo',
        ));
        $builder->add('created_at', 'date', array(
            'label' => 'demo.admin.news.list.created_at',
            'widget' => 'single_text'
        ));
        $builder->add('visible', 'checkbox', array(
            'label' => 'demo.admin.news.list.visible',
            'required' => false
        ));
        $builder->add('creator_email', 'email', array(
            'label' => 'demo.admin.news.list.creator_email'
        ));

        return $builder->getForm();
    }
}
