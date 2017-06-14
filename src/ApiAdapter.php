<?php

declare(strict_types=1);

namespace BT\FlysystemAdapter;

use GuzzleHttp\Client;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Config;
use League\Flysystem\NotSupportedException;

class ApiAdapter extends AbstractAdapter
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * ApiAdapter constructor.
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Write a new file.
     *
     * @param string $path
     * @param string $contents
     * @param Config $config Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function write($path, $contents, Config $config)
    {
        $data = [
            'path' => $path,
            'contents' => $contents,
            'config' => []
        ];

        $this->client->post('/write',['data' => json_encode($data)]);
    }

    /**
     * Write a new file using a stream.
     *
     * @param string $path
     * @param resource $resource
     * @param Config $config Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function writeStream($path, $resource, Config $config)
    {
        $data = [
            'path' => $path,
            'contents' => $resource,
            'config' => []
        ];

        $this->client->post('/write-stream', ['data' => json_encode($data)]);
    }

    /**
     * Update a file.
     *
     * @param string $path
     * @param string $contents
     * @param Config $config Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function update($path, $contents, Config $config)
    {
        $data = [
            'path' => $path,
            'contents' => $contents,
            'config' => []
        ];

        $this->client->post('/update', ['data' => json_encode($data)]);
    }

    /**
     * Update a file using a stream.
     *
     * @param string $path
     * @param resource $resource
     * @param Config $config Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function updateStream($path, $resource, Config $config)
    {
        $data = [
            'path' => $path,
            'contents' => $resource,
            'config' => []
        ];

        $this->client->post('/write-stream', ['data' => json_encode($data)]);
    }

    /**
     * Rename a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function rename($path, $newpath)
    {
        $data = [
            'path' => $path,
            'newpath' => $newpath
        ];

        $this->client->post('/rename', ['data' => json_encode($data)]);
    }

    /**
     * Copy a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function copy($path, $newpath)
    {
        $data = [
            'path' => $path,
            'newpath' => $newpath
        ];

        $this->client->post('/copy', ['data' => json_encode($data)]);
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @return bool
     */
    public function delete($path)
    {
        $data = [
            'path' => $path
        ];

        $this->client->post('/delete', ['data' => json_encode($data)]);
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @return bool
     */
    public function deleteDir($dirname)
    {
        $data = [
            'dirname' => $dirname
        ];

        $this->client->post('/delete-dir', ['data' => json_encode($data)]);
    }

    /**
     * Create a directory.
     *
     * @param string $dirname directory name
     * @param Config $config
     *
     * @return array|false
     */
    public function createDir($dirname, Config $config)
    {
        $data = [
            'dirname' => $dirname,
            'config' => []
        ];

        $this->client->post('/create-dir', ['data' => json_encode($data)]);
    }

    /**
     * Set the visibility for a file.
     *
     * @param string $path
     * @param string $visibility
     *
     * @return array|false file meta data
     */
    public function setVisibility($path, $visibility)
    {
        return;
    }

    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return array|bool|null
     */
    public function has($path)
    {
        $data = [
            'path' => $path,
        ];

        return (bool)$this->client->get('/has', ['data' => json_encode($data)])->getBody()->getContents();
    }

    /**
     * Read a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function read($path)
    {
        $data = [
            'path' => $path,
        ];

        return json_decode($this->client->get('/read', ['data' => json_encode($data)])->getBody()->getContents(), true);
    }

    /**
     * Read a file as a stream.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function readStream($path)
    {
        throw new NotSupportedException();
    }

    /**
     * List contents of a directory.
     *
     * @param string $directory
     * @param bool $recursive
     *
     * @return array
     */
    public function listContents($directory = '', $recursive = false)
    {
        throw new NotSupportedException();
    }

    /**
     * Get all the meta data of a file or directory.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getMetadata($path)
    {
        throw new NotSupportedException();
    }

    /**
     * Get the size of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getSize($path)
    {
        throw new NotSupportedException();
    }

    /**
     * Get the mimetype of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getMimetype($path)
    {
        throw new NotSupportedException();
    }

    /**
     * Get the timestamp of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getTimestamp($path)
    {
        throw new NotSupportedException();
    }

    /**
     * Get the visibility of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getVisibility($path)
    {
        throw new NotSupportedException();
    }
}
