<?php

namespace MythicalSystems\Helpers;

use FilesystemIterator;

final class GarbageCollector {
    /**
     * Throw away a value
     * 
     * @param mixed $value The value to throw away
     * 
     * @return void
     */
    public static function throwAway(mixed $value) {
        unset($value);
    }
    /**
     * Throw away all values in an array
     * 
     * @param array $values The values to throw away
     * 
     * @return void
     */
    public static function throwAwayAll(array $values) {
        foreach ($values as $value) {
            self::throwAway($value);
        }
    }
    /**
     * Call the garbage collector to free up memory
     * 
     * @return void
     */
    public static function callGarbageCollector() {
        gc_enable();
        gc_mem_caches();
        gc_collect_cycles();
        gc_disable();
    }
    /**
     * Delete all files in a directory
     * 
     * @param string $directory The directory to delete all files in
     * 
     * @return void 
     */
    public static function deleteAllFilesInDirectory(string $directory) {
        $files = new FilesystemIterator($directory);
        foreach ($files as $file) {
            unlink($file->getPathname());
        }
    }
    /**
     * Delete all files in a directory recursively
     * 
     * @param string $directory The directory to delete all files in
     * 
     * @return void 
     */
    public static function deleteAllFilesInDirectoryRecursively(string $directory) {
        $files = new FilesystemIterator($directory);
        foreach ($files as $file) {
            if ($file->isDir()) {
                self::deleteAllFilesInDirectoryRecursively($file->getPathname());
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
    }

}