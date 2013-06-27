<?php

namespace Tavs\Twig;

/**
 * Extensão do Twig
 */
class Extension extends \Twig_Extension
{
    /**
     * @var \Zend_View_Abstract
     */
    private $view;

    /**
     * @param \Zend_View_Abstract $view
     */
    public function __construct(\Zend_View_Abstract $view)
    {
        $this->view = $view;
    }

    /**
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('helper', array($this, 'helper'), array('is_safe' => array('html')))
        );
    }

    /**
     * @param nome $name
     *
     * @return mixed
     */
    public function helper($name)
    {
        $arguments = array_slice(func_get_args(), 1);
        $helper = $this->view->getHelper($name);
        return call_user_func_array(array($helper, $name), $arguments);
    }

    /**
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return "tavs_extension";
    }
}