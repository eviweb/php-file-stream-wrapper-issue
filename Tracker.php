<?php

/**
 * global tracker
 */
final class Tracker
{
    /**
     * global tracker instance
     *
     * @var Tracker
     */
    private static $instance;

    /**
     * internal counter
     *
     * @var integer
     */
    private $counter;

    /**
     * constructor
     */
    private function __construct()
    {
        $this->reset();
    }

    /**
     * get the global tracker instance (Singleton)
     *
     * @return Tracker
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * increase the counter
     */
    public function increase()
    {
        $this->counter++;
    }

    /**
     * reset the counter
     */
    public function reset()
    {
        $this->counter = 0;
    }

    /**
     * get the counter value
     * 
     * @return integer
     */
    public function getCounter()
    {
        return $this->counter;
    }
}
