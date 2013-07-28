<?php

namespace Tavs\Db\Profiler;

use \Doctrine\DBAL\Logging\SQLLogger;

/**
 * Class DoctrineLogger
 * @package My
 */
class DoctrineLogger extends \Zend_Db_Profiler_Firebug implements SQLLogger
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
        $this->setEnabled(true);
    }

    /**
     * Logs a SQL statement somewhere.
     *
     * @param string $sql The SQL to be executed.
     * @param array $params The SQL parameters.
     * @param array $types The SQL parameter types.
     * @return void
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->lastQueryId = parent::queryStart($sql);

        // passa os parametros para a query
        $this->getQueryProfile($this->lastQueryId)->bindParams($params);
    }

    /**
     * Mark the last started query as stopped. This can be used for timing of queries.
     *
     * @return void
     */
    public function stopQuery()
    {
        parent::queryEnd($this->lastQueryId);
    }

}
