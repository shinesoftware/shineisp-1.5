<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */


$dbParams = array(
        'hostname'  => 'localhost',
        'driver' => 'Pdo',
        'database' => 'shineisp2',
        'username' => 'root',
        'password' => '11041977',
        // buffer_results - only for mysqli buffered queries, skip for others
        'options' => array('buffer_results' => true),
);
return array(
        'service_manager' => array(
                'factories' => array(
                        'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                            $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                                    'driver'    => 'pdo',
                                    'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                                    'username'  => $dbParams['username'],
                                    'password'  => $dbParams['password'],
                                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
                            ));

                            if (php_sapi_name() == 'cli') {
                                $logger = new Zend\Log\Logger();
                                // write queries profiling info to stdout in CLI mode
                                $writer = new Zend\Log\Writer\Stream('php://output');
                                $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                                $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                            } else {
                                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                            }
                            if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                                $options = $dbParams['options'];
                            } else {
                                $options = array();
                            }
                            $adapter->injectProfilingStatementPrototype($options);
                            return $adapter;
                        },
                ),
        ),
);
