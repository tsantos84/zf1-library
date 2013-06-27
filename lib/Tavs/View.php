<?php
namespace Tavs;

use Tavs\Twig\Extension;

use Tavs\Twig\HelperFunction;

use Tavs\Twig\Environment;

class View extends \Zend_View_Abstract
{
    /**
     * @var \Twig_Environment
     */
    private $_environmnet;

    /**
     * Inicializa a engine
     */
    public function __construct($config = array())
    {
        $this->_environmnet = new \Twig_Environment(
            new \Twig_Loader_Filesystem(),
            $config
        );

        $this->_environmnet->addExtension(new Extension($this));

        parent::__construct($config);
    }

    /**
     * @see Zend_View_Abstract::setScriptPath()
     */
    public function setScriptPath($path)
    {
        if (is_array($path)) {
            $this->_environmnet->getLoader()->setPaths($path);
        }
    }

    /**
     * @see Zend_View_Abstract::addScriptPath()
     */
    public function addScriptPath($path)
    {
        $this->_environmnet->getLoader()->addPath($path);
        return $this;
    }

    /**
     * @see Zend_View_Abstract::getScriptPaths()
     */
    public function getScriptPaths()
    {
        return $this->_environmnet->getLoader()->getPaths();
    }

    /**
     * @see Zend_View_Abstract::_script()
     */
    public function _script($name)
    {
        return $name;
    }

    /**
     * @see Zend_View_Interface::getEngine()
     */
    public function getEngine()
    {
        return $this->_environmnet;
    }

    /**
     * Renderiza a view
     */
    protected function _run()
    {
        echo $this->_environmnet->render(func_get_arg(0), $this->getVars());
    }
}