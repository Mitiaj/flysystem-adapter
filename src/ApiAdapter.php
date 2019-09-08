<?php

declare(strict_types=1);

namespace BT\FlysystemAdapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Config;

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
        try {
            $result = $this->client->post('write', [
                    'query' => ['path' => $path],
                    'body' => $contents
                ]
            );

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];
        } catch (RequestException $e) {
            throw;
        }
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
        try {
            $result = $this->client->post('write-stream', [
                'query' => ['path' => $path],
                'body' => $resource
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];
        } catch (RequestException $e) {
            throw;
        }
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
        try {
            $result = $this->client->post('update', [
                'query' => ['path' => $path],
                'body' => $contents
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];
        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->post('update', [
                'query' => ['path' => $path],
                'body' => $resource
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];
        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->post('rename', [
                'query' => [
                    'path' => $path,
                    'newpath' => $newpath
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];
        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->post('copy', [
                'query' => [
                    'path' => $path,
                    'newpath' => $newpath
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->post('delete', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->post('delete-dir', [
                'query' => [
                    'dirname' => $dirname,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->post('create-dir', [
                'query' => [
                    'dirname' => $dirname,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->get('has', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return null;
        }
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
        try {
            $result = $this->client->get('read', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->get('read', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->get('list-contents', [
                'query' => [
                    'directory' => $directory,
                    'recursive' => $recursive
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return [];
        }
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
        try {
            $result = $this->client->get('get-metadata', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->get('get-size', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->get('get-mimetype', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        try {
            $result = $this->client->get('get-timestamp', [
                'query' => [
                    'path' => $path,
                ]
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            return $response['response'];

        } catch (RequestException $e) {
            return false;
        }
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
        return false;
    }
}
