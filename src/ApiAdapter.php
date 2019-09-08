<?php
declare(strict_types=1);

namespace BT\FlysystemAdapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Config;
use League\Flysystem\Exception;

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
     * @throws Exception
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
            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
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
     * @throws Exception
     */
    public function writeStream($path, $resource, Config $config)
    {
        try {
            $result = $this->client->post('write-stream', [
                'query' => ['path' => $path],
                'body' => $resource
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
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
     * @throws Exception
     */
    public function update($path, $contents, Config $config)
    {
        try {
            $result = $this->client->post('update', [
                'query' => ['path' => $path],
                'body' => $contents
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
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
     * @throws Exception
     */
    public function updateStream($path, $resource, Config $config)
    {
        try {
            $result = $this->client->post('update', [
                'query' => ['path' => $path],
                'body' => $resource
            ]);

            $response = json_decode($result->getBody()->getContents(), true);

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Rename a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Copy a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @return bool
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @return bool
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Create a directory.
     *
     * @param string $dirname directory name
     * @param Config $config
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
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
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Read a file.
     *
     * @param string $path
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Read a file as a stream.
     *
     * @param string $path
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * List contents of a directory.
     *
     * @param string $directory
     * @param bool $recursive
     *
     * @return array
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get all the meta data of a file or directory.
     *
     * @param string $path
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get the size of a file.
     *
     * @param string $path
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get the mimetype of a file.
     *
     * @param string $path
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get the timestamp of a file.
     *
     * @param string $path
     *
     * @return array|false
     * @throws Exception
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

            if ($response['response']) {
                return true;
            }

            throw new Exception($response['message']);

        } catch (RequestException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
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
