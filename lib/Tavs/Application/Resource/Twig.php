<?php

namespace Tavs\Application\Resource;

use Tavs\View;

class Twig extends \Zend_Application_Resource_View
{
    public function init()
    {
        parent::init();
        $viewRenderer = \Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setViewSuffix('twig');
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

            if (isset($options['debug']) && (bool) $options['debug']) {
                $twig = $this->_view->getEngine();
                $twig->enableDebug();
                $twig->addExtension(new \Twig_Extension_Debug());
            }
        }

        return $this->_view;
    }
}
