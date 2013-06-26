<?php

namespace Tavs\Application\Resource;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Doctrine extends \Zend_Application_Resource_ResourceAbstract
{
    /**
     * @var EntityManager
     */
    private $_em;

    /**
     * @see Zend_Application_Resource_Resource::init()
     */
    public function init()
    {
        return $this->getEntityManager();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->_em) {

            $options = $this->getOptions();

            if (isset($options['orm'])) {

                $paths = is_array($options['orm']['entities']) ? $options['orm']['entities'] : array();
                $isDevMode = APPLICATION_ENV != 'production' ;

                // the connection configuration
                $dbParams = $options['orm']['parameters'];

                $config = Setup::createAnnotationMetadataConfiguration($paths, true);
                $this->_em = EntityManager::create($dbParams, $config);
            }
        }

        return $this->_em;
    }

}