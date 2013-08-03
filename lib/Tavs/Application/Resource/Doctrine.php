<?php

namespace Tavs\Application\Resource;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Tavs\Db\Profiler\DoctrineProfiler;

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

                // profiler
                $profiler = new DoctrineProfiler();
                $profiler->setEnabled(isset($options['profiler_enabled']) && (bool)$options['profiler_enabled']);
                $this->_em->getConfiguration()->setSQLLogger($profiler);
            }
        }

        return $this->_em;
    }

}
