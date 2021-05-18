<?php

namespace ILDaviz\LaravelPhpseclib;

use ILDaviz\LaravelPhpseclib\Exceptions\BadLogin;
use ILDaviz\LaravelPhpseclib\Exceptions\CoreException;
use phpseclib3\Net\SFTP;
use UnexpectedValueException;

/**
 * Class LaravelPhpseclib
 * @package ILDaviz\LaravelPhpseclib
 */
class LaravelPhpseclib implements LaravelPhpseclibInterface
{
    /**
     * Object of SFTP For Facades
     * @var SFTP
     */
    private $sftp;

    /**
     * Login
     * @param string $username
     * @param string $password
     * @param string $host
     * @param int $port
     * @param int $timeout
     * @return LaravelPhpseclib
     * @throws BadLogin
     * @throws CoreException
     */
    public function login(string $username, string $password, string $host = 'localhost', int $port = 22, int $timeout = 10): LaravelPhpseclib
    {
        try {
            $this->sftp = new SFTP($host, $port, $timeout);
            if (!$this->sftp->login('username', 'password')) {
                throw new BadLogin('Bad Login! Username or Password is not correct');
            }
            return $this;
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Disable or Enable the stat cache
     * @param bool $status
     * @return LaravelPhpseclib
     */
    public function StateCache(bool $status = true): LaravelPhpseclib
    {
        if ($status) {
            $this->sftp->enableStatCache();
        } else {
            $this->sftp->disableStatCache();
        }
        return $this;
    }

    /**
     * This method erase the stat cache
     * @return LaravelPhpseclib
     */
    public function ClearStatCache(): LaravelPhpseclib
    {
        $this->sftp->clearStatCache();
        return $this;
    }

    /**
     * Enable or Disable path canonicalization
     * @param bool $status
     * @return LaravelPhpseclib
     */
    public function StatePathCanonicalization(bool $status = true): LaravelPhpseclib
    {
        if ($status) {
            $this->sftp->enablePathCanonicalization();
        } else {
            $this->sftp->disablePathCanonicalization();
        }
        return $this;
    }

    /**
     * Returns the current directory name
     *
     * @return bool|string|mixed
     * @access public
     */
    public function pwd(): mixed
    {
        return $this->sftp->pwd();
    }

    /**
     * Canonicalize the Server-Side Path Name
     * @param string $path
     * @return mixed
     * @throws CoreException
     */
    public function realPath(string $path): mixed
    {
        try {
            return $this->sftp->realpath($path);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }

    }

    /**
     * Changes the current directory
     * @param string $dir
     * @return LaravelPhpseclib
     * @throws CoreException
     */
    public function chdir(string $dir): LaravelPhpseclib
    {
        try {
            if ($this->sftp->chdir($dir)) {
                return $this;
            } else {
                throw new CoreException();
            }
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Defines how nlist() and rawlist() will be sorted - if at all.
     * If sorting is enabled directories and files will be sorted independently with
     * directories appearing before files in the resultant array that is returned.
     * Any parameter returned by stat is a valid sort parameter for this function.
     * Filename comparisons are case insensitive.
     *
     * Examples:
     *
     * $sftp->setListOrder('filename', SORT_ASC);
     * $sftp->setListOrder('size', SORT_DESC, 'filename', SORT_ASC);
     * @param string[] ...$args
     * @access public
     */
    public function setListOrder(...$args): LaravelPhpseclib
    {
        $this->sftp->setListOrder(...$args);
        return $this;
    }

    /**
     * Returns a list of files in the given directory
     * @param string $dir
     * @param false $recursive
     * @return mixed
     */
    public function nlist(string $dir = '.', bool $recursive = false): mixed
    {
        return $this->sftp->nlist($dir, $recursive);
    }

    /**
     * Returns a detailed list of files in the given directory
     * @param string $dir
     * @param false $recursive
     * @return mixed
     */
    public function rawList(string $dir = '.', bool $recursive = false): mixed
    {
        return $this->sftp->rawlist($dir, $recursive);
    }

    /**
     * Returns general information about a file.
     * Returns an array on success and false otherwise.
     *
     * @param string $filename
     * @return mixed
     */
    public function stat(string $filename): mixed
    {
        return $this->sftp->stat($filename);
    }

    /**
     * Returns general information about a file or symbolic link.
     * Returns an array on success and false otherwise.
     *
     * @param string $filename
     * @return mixed
     * @access public
     */
    public function lstat(string $filename): mixed
    {
        return $this->sftp->lstat($filename);
    }

    /**
     * Truncates a file to a given length
     *
     * @param string $filename
     * @param int $new_size
     * @return bool
     */
    public function truncate(string $filename, int $new_size): bool
    {
        return $this->sftp->truncate($filename, $new_size);
    }

    /**
     * Sets access and modification time of file.
     * If the file does not exist, it will be created.
     *
     * @param string $filename
     * @param int|null $time
     * @param int|null $atime
     * @return bool
     * @throws CoreException
     */
    public function touch(string $filename, int $time = null, int $atime = null): bool
    {
        try {
            return $this->sftp->touch($filename, $time, $atime);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Changes file or directory owner
     * Returns true on success or false on error.
     *
     * @param string $filename
     * @param int $uid
     * @param bool $recursive
     * @return bool
     */
    public function chown(string $filename, int $uid, bool $recursive = false): bool
    {
        return $this->sftp->chown($filename, $uid, $recursive);
    }

    /**
     * Changes file or directory group
     * Returns true on success or false on error.
     *
     * @param string $filename
     * @param int $gid
     * @param bool $recursive
     * @return bool
     */
    public function chgrp(string $filename, int $gid, bool $recursive = false): bool
    {
        return $this->sftp->chgrp($filename, $gid, $recursive);
    }

    /**
     * Set permissions on a file.
     *
     * Returns the new file permissions on success or false on error.
     * If $recursive is true than this just returns true or false.
     *
     * @param int $mode
     * @param string $filename
     * @param bool $recursive
     * @return mixed
     * @throws CoreException
     */
    public function chmod(int $mode, string $filename, bool $recursive = false): mixed
    {
        try {
            return $this->sftp->chmod($mode, $filename, $recursive);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Return the target of a symbolic link
     *
     * @param string $link
     * @return mixed
     * @throws CoreException
     */
    public function readLink(string $link)
    {
        try {
            return $this->sftp->readlink($link);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Create a symlink
     *
     * symlink() creates a symbolic link to the existing target with the specified name link.
     *
     * @param string $target
     * @param string $link
     * @return bool
     * @throws CoreException
     */
    public function symlink(string $target, string $link): bool
    {
        try {
            return $this->sftp->symlink($target, $link);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Creates a directory.
     *
     * @param string $dir
     * @param int $mode
     * @param bool $recursive
     * @return bool
     * @throws CoreException
     */
    public function mkdir(string $dir, int $mode = -1, bool $recursive = false): bool
    {
        try {
            return $this->sftp->mkdir($dir, $mode, $recursive);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Removes a directory.
     *
     * @param string $dir
     * @return bool
     * @throws CoreException
     * @access public
     */
    public function rmdir(string $dir): bool
    {
        try {
            return $this->sftp->rmdir($dir);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Uploads a file to the SFTP server.
     *
     * @param string $remote_file
     * @param string $data
     * @return bool
     * @access public
     * @throws CoreException
     */
    public function put(string $remote_file, string $data): bool
    {
        try {
            return $this->sftp->put($remote_file, $data);
        } catch (UnexpectedValueException | BadFunctionCallException | phpseclib3\Exception\FileNotFoundException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Put multiple file on folder
     * Array structure:
     * [
     *      [
     *          'remote_file': '', // Opzionale Url remoto di caricamento se diverso da quello in sftp
     *          'content_file': '', // Contenuto del file se di tipo stringa o binario o di altro tipo
     *          'path_content_file': '', // Opzionale Eventuale presenza del file in cache così da caricarlo direttamente
     *          'overwrite': false, // In caso di presenza del file sovrascrivo?
     *      ]
     * ]
     * @param array $items
     * @return bool
     */
    public function putMultipleFile(array $items): bool
    {
        $sftp = $this->sftp;

        foreach ($items as $item) {

        }

    }

    /**
     * Downloads a file from the SFTP server.
     * Returns a string containing the contents of $remote_file if $local_file is left undefined or a boolean false if
     * the operation was unsuccessful.  If $local_file is defined, returns true or false depending on the success of the
     * operation.
     *
     * $offset and $length can be used to download files in chunks.
     *
     * @param string $remote_file
     * @param string|bool|resource|callable $local_file
     * @param int $offset
     * @param int $length
     * @param callable|null $progressCallback
     * @return mixed
     * @throws CoreException
     */
    public function get(string $remote_file, $local_file = false, int $offset = 0, int $length = -1, callable $progressCallback = null): mixed
    {
        try {
            return $this->sftp->get($remote_file, $local_file, $offset, $length, $progressCallback);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Deletes a file on the SFTP server.
     *
     * @param string $path
     * @param bool $recursive
     * @return bool
     * @throws CoreException
     */
    public function delete(string $path, bool $recursive = true): bool
    {
        try {
            return $this->sftp->delete($path, $recursive);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Checks whether a file or directory exists
     *
     * @param string $path
     * @return LaravelPhpseclib
     */
    public function file_exists(string $path): bool
    {
        return $this->sftp->file_exists($path);
    }

    /**
     * Tells whether the filename is a directory
     *
     * @param string $path
     * @return bool
     */
    public function is_dir(string $path): bool
    {
        return $this->sftp->is_dir($path);
    }

    /**
     * Tells whether the filename is a regular file
     *
     * @param string $path
     * @return bool
     */
    public function is_file(string $path): bool
    {
        return $this->sftp->is_file($path);
    }

    /**
     * Tells whether the filename is a symbolic link
     *
     * @param string $path
     * @return bool
     */
    public function is_link(string $path): bool
    {
        return $this->sftp->is_link($path);
    }

    /**
     * Tells whether a file exists and is readable
     *
     * @param string $path
     * @return bool
     * @throws CoreException
     */
    public function is_readable(string $path): bool
    {
        try {
            return $this->sftp->is_readable($path);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Tells whether the filename is writable
     *
     * @param string $path
     * @return bool
     * @throws CoreException
     */
    public function is_writable(string $path): bool
    {
        try {
            return $this->sftp->is_writable($path);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * Gets last access time of file
     *
     * @param string $path
     * @return mixed
     */
    public function fileatime(string $path)
    {
        return $this->sftp->fileatime($path);
    }

    /**
     * Gets file modification time
     *
     * @param string $path
     * @return mixed
     */
    public function filemtime(string $path)
    {
        return $this->sftp->filemtime($path);
    }

    /**
     * Gets file permissions
     *
     * @param string $path
     * @return mixed
     */
    public function fileperms(string $path)
    {
        return $this->sftp->filemtime($path);
    }

    /**
     * Gets file owner
     *
     * @param string $path
     * @return mixed
     */
    public function fileowner(string $path)
    {
        return $this->sftp->fileowner($path);
    }

    /**
     * Gets file group
     *
     * @param string $path
     * @return mixed
     */
    public function filegroup(string $path)
    {
        return $this->sftp->filegroup($path);
    }

    /**
     * Gets file size
     *
     * @param string $path
     * @return mixed
     */
    public function filesize(string $path)
    {
        return $this->sftp->filesize($path);
    }

    /**
     * Gets file type
     *
     * @param string $path
     * @return mixed
     */
    public function filetype(string $path)
    {
        return $this->sftp->filetype($path);
    }

    /**
     * Renames a file or a directory on the SFTP server
     *
     * @param string $oldname
     * @param string $newname
     * @return bool
     * @throws CoreException
     */
    public function rename(string $oldname, string $newname): bool
    {
        try {
            return $this->sftp->rename($oldname, $newname);
        } catch (UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }
    }

    /**
     * This method reset connection
     * @return null $this
     */
    public function resetConnection()
    {
        $this->sftp = null;
        return $this;
    }
}
