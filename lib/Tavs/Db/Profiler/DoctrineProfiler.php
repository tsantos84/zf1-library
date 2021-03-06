<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tsantos
 * Date: 28/07/13
 * Time: 11:56
 * To change this template use File | Settings | File Templates.
 */

namespace Tavs\Db\Profiler;

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * Class DoctrineProfiler
 * @package Tavs\Db\Profiler
 */
class DoctrineProfiler extends \Zend_Db_Profiler_Firebug implements SQLLogger
{
    /**
     * @var integer
     */
    private $lastQueryId;

    /**
     * Construtor
     */
    public function __construct()
    {
        parent::__construct('Doctrine Query Profiler');
    }

    /**
     * Inicia o profile de uma consulta
     *
     * @param $sql
     * @param array $params
     * @param array $types
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->lastQueryId = $this->queryStart($sql);
        $this->getQueryProfile($this->lastQueryId)->bindParams($params);
    }

    /**
     * Finaliza o profile da query
     */
    public function stopQuery()
    {
        $this->queryEnd($this->lastQueryId);
    }
}
