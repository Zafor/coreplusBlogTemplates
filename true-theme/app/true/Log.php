<?php
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class LogWriter
{

    /**
     * Monolog writer instance
     *
     * @var \Monolog\Logger
     */
    protected $log;

    /**
     * Configure log client
     *
     * @return void
     */
    public function configure($config)
    {
        // create a log channel
        $pathToLog = rtrim(array_get($config, 'path'), '/') . '/log.txt';
        $handler = new RotatingFileHandler($pathToLog, 30);
        $this->log = new Logger('wp');
        $this->log->pushHandler($handler);
    }

    /**
     * Writes 'debug' level information to log file
     *
     * @param string $message
     * @param array $context Additional information to be written to log file
     *
     * @return void
     */
    public function debug($message, $context = [])
    {
        $this->log->debug($message, $context);
    }

    /**
     * Writes 'info' level information to log file
     *
     * @param string $message
     * @param array $context Additional information to be written to log file
     *
     * @return void
     */
    public function info($message, $context = [])
    {
        $this->log->info($message, $context);
    }

    /**
     * Writes 'notice' level information to log file
     *
     * @param string $message
     * @param array $context Additional information to be written to log file
     *
     * @return void
     */
    public function notice($message, $context = [])
    {
        $this->log->notice($message, $context);
    }

    /**
     * Writes 'warning' level information to log file
     *
     * @param string $message
     * @param array $context Additional information to be written to log file
     *
     * @return void
     */
    public function warning($message, $context = [])
    {
        $this->log->warning($message, $context);
    }

    /**
     * Writes 'error' level information to log file
     *
     * @param string $message
     * @param array $context Additional information to be written to log file
     *
     * @return void
     */
    public function error($message, $context = [])
    {
        $this->log->error($message, $context);
    }
}

$manager = new LogWriter();
$manager->configure([
    'path' => get_template_directory() . '/logs'
]);

$GLOBALS['logwriter'] = $manager;
