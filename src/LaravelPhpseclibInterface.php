<?php

namespace ILDaviz\LaravelPhpseclib;

interface LaravelPhpseclibInterface
{
    /**
     * Login
     * @param string $username
     * @param string $password
     * @param string $host
     * @param int $port
     * @param int $timeout
     * @return LaravelPhpseclib
     */
    public function login(string $username, string $password, string $host = 'localhost', int $port = 22, int $timeout = 10): LaravelPhpseclib;

    /**
     * Disable or Enable the stat cache
     * @param bool $status
     * @return LaravelPhpseclib
     */
    public function StateCache(bool $status = true): LaravelPhpseclib;

    /**
     * This method erase the stat cache
     * @return LaravelPhpseclib
     */
    public function ClearStatCache(): LaravelPhpseclib;

    /**
     * Enable or Disable path canonicalization
     * @param bool $status
     * @return LaravelPhpseclib
     */
    public function StatePathCanonicalization(bool $status = true): LaravelPhpseclib;

    /**
     * Returns the current directory name
     *
     * @return bool|string|mixed
     * @access public
     */
    public function pwd(): mixed;

    /**
     * Canonicalize the Server-Side Path Name
     * @param string $path
     * @return mixed
     */
    public function realPath(string $path): mixed;

    /**
     * Changes the current directory
     * @param string $dir
     * @return LaravelPhpseclib
     */
    public function chdir(string $dir): LaravelPhpseclib;

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
    public function setListOrder(...$args): LaravelPhpseclib;

    /**
     * Returns a list of files in the given directory
     * @param string $dir
     * @param false $recursive
     * @return mixed
     */
    public function nlist(string $dir = '.', bool $recursive = false): mixed;

    /**
     * Returns a detailed list of files in the given directory
     * @param string $dir
     * @param false $recursive
     * @return mixed
     */
    public function rawList(string $dir = '.', bool $recursive = false): mixed;

    /**
     * Returns general information about a file.
     * Returns an array on success and false otherwise.
     *
     * @param string $filename
     * @return mixed
     */
    public function stat(string $filename): mixed;

    /**
     * Returns general information about a file or symbolic link.
     * Returns an array on success and false otherwise.
     *
     * @param string $filename
     * @return mixed
     * @access public
     */
    public function lstat(string $filename): mixed;

    /**
     * Truncates a file to a given length
     *
     * @param string $filename
     * @param int $new_size
     * @return bool
     */
    public function truncate(string $filename, int $new_size): bool;


    /**
     * Sets access and modification time of file.
     * If the file does not exist, it will be created.
     *
     * @param string $filename
     * @param int|null $time
     * @param int|null $atime
     * @return bool
     */
    public function touch(string $filename, int $time = null, int $atime = null): bool;

    /**
     * Changes file or directory owner
     * Returns true on success or false on error.
     *
     * @param string $filename
     * @param int $uid
     * @param bool $recursive
     * @return bool
     */
    public function chown(string $filename, int $uid, bool $recursive = false): bool;


    /**
     * Changes file or directory group
     * Returns true on success or false on error.
     *
     * @param string $filename
     * @param int $gid
     * @param bool $recursive
     * @return bool
     */
    public function chgrp(string $filename, int $gid, bool $recursive = false): bool;

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
     */
    public function chmod(int $mode, string $filename, bool $recursive = false): mixed;

    /**
     * Return the target of a symbolic link
     *
     * @param string $link
     * @return mixed
     */
    public function readLink(string $link);

    /**
     * Create a symlink
     *
     * symlink() creates a symbolic link to the existing target with the specified name link.
     *
     * @param string $target
     * @param string $link
     * @return bool
     */
    public function symlink(string $target, string $link): bool;

    /**
     * Creates a directory.
     *
     * @param string $dir
     * @param int $mode
     * @param bool $recursive
     * @return bool
     */
    public function mkdir(string $dir, int $mode = -1, bool $recursive = false): bool;

    /**
     * Removes a directory.
     *
     * @param string $dir
     * @return bool
     */
    public function rmdir(string $dir): bool;

    /**
     * Uploads a file to the SFTP server.
     *
     * @param string $remote_file
     * @param string $data
     * @return bool
     * @access public
     */
    public function put(string $remote_file, string $data ): bool;

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
     */
    public function get(string $remote_file, $local_file = false, int $offset = 0, int $length = -1, callable $progressCallback = null): mixed;

    /**
     * Deletes a file on the SFTP server.
     *
     * @param string $path
     * @param bool $recursive
     * @return bool
     */
    public function delete(string $path, bool $recursive = true): bool;

    /**
     * Checks whether a file or directory exists
     *
     * @param string $path
     * @return LaravelPhpseclib
     */
    public function file_exists(string $path): bool;

    /**
     * Tells whether the filename is a directory
     *
     * @param string $path
     * @return bool
     */
    public function is_dir(string $path): bool;

    /**
     * Tells whether the filename is a regular file
     *
     * @param string $path
     * @return bool
     */
    public function is_file(string $path): bool;

    /**
     * Tells whether the filename is a symbolic link
     *
     * @param string $path
     * @return bool
     */
    public function is_link(string $path): bool;


    /**
     * Tells whether a file exists and is readable
     *
     * @param string $path
     * @return bool
     */
    public function is_readable(string $path): bool;

    /**
     * Tells whether the filename is writable
     *
     * @param string $path
     * @return bool
     */
    public function is_writable(string $path): bool;

    /**
     * Gets last access time of file
     *
     * @param string $path
     * @return mixed
     */
    public function fileatime(string $path);

    /**
     * Gets file modification time
     *
     * @param string $path
     * @return mixed
     */
    public function filemtime(string $path);

    /**
     * Gets file permissions
     *
     * @param string $path
     * @return mixed
     */
    public function fileperms(string $path);



    /**
     * Gets file owner
     *
     * @param string $path
     * @return mixed
     */
    public function fileowner(string $path);

    /**
     * Gets file group
     *
     * @param string $path
     * @return mixed
     */
    public function filegroup(string $path);

    /**
     * Gets file size
     *
     * @param string $path
     * @return mixed
     */
    public function filesize(string $path);

    /**
     * Gets file type
     *
     * @param string $path
     * @return mixed
     */
    public function filetype(string $path);

    /**
     * Renames a file or a directory on the SFTP server
     *
     * @param string $oldname
     * @param string $newname
     * @return bool
     */
    public function rename(string $oldname, string $newname): bool;

    /**
     * This method reset connection
     */
    public function resetConnection();


}