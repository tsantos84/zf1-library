<?php

namespace Tavs\Application\Resource;

use My\View;

class Twig extends \Zend_Application_Resource_View
{
    public function init()
    {
        parent::init();
        $viewRenderer = \Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setViewSuffix('html.twig');
    }

    /**
     * @see Zend_Application_Resource_View::getView()
     */
    public function getView()
    {
        if (null === $this->_view) {

            $options = $this->getOptions();
            $this->_view = new View($options);

            if (isset($options['assign']) && is_array($options['assign'])) {
                $this->_view->assign($options['assign']);
            }
        }

        return $this->_view;
    }
}