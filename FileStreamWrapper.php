<?php

/**
 * basic file stream wrapper
 *
 * it uses the global tracker instance
 */
final class FileStreamWrapper
{
    /**
     * stream protocol
     */
    const STREAM_PROTOCOL = 'file';

    /**
     * file handler
     *
     * @var Resource
     */
    private $resource;

    /**
     * constructor
     */
    public function __construct()
    {
        Tracker::getInstance()->increase();
    }

    /**
     * register this class as file stream wrapper
     */
    public static function wrap()
    {
        stream_wrapper_unregister(self::STREAM_PROTOCOL);
        stream_wrapper_register(self::STREAM_PROTOCOL, __CLASS__);
    }

    /**
     * restore the original file stream wrapper
     */
    public static function unwrap()
    {
        stream_wrapper_restore(self::STREAM_PROTOCOL);
    }

    /**
     * open stream handler
     *
     * @see http://php.net/manual/fr/streamwrapper.stream-open.php
     */
    public function stream_open($path, $mode, $options, &$openedPath)
    {
        $this->unwrap();
        $this->resource = fopen($path, $mode, $options);
        $this->wrap();

        return $this->resource !== false;
    }

    /**
     * stream stat handler
     *
     * @see http://php.net/manual/fr/streamwrapper.stream-stat.php
     */
    public function stream_stat()
    {
        return fstat($this->resource);
    }

    /**
     * stream url stat handler
     *
     * @see http://php.net/manual/fr/streamwrapper.url-stat.php
     */
    public function url_stat()
    {
        $this->unwrap();
        $result = stat($path);
        $this->wrap();

        return $result;
    }

    /**
     * read stream handler
     *
     * @see http://php.net/manual/fr/streamwrapper.stream-read.php
     */
    public function stream_read($count)
    {
        return fread($this->resource, $count);
    }

    /**
     * end of file stream handler
     *
     * @see http://php.net/manual/fr/streamwrapper.stream-eof.php
     */
    public function stream_eof()
    {
        return feof($this->resource);
    }

    /**
     * close stream handler
     *
     * @see http://php.net/manual/fr/streamwrapper.stream-close.php
     */
    public function stream_close()
    {
        return fclose($this->resource);
    }
}