<?php
namespace MythicalSystems\Helpers;

class UnitTestHelper
{
    /**
     * Init a unit test
     * 
     * @param string $name The unit test name
     * @param int $id The unit test id
     * 
     * @return bool Failed or success?
     */
    public static function init(string $name, int $id): bool
    {
        if (isset ($name) && !$name == null) {
            if (isset ($id) && !$id == null) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Start an unit test
     * 
     * @param int $id The id of the test
     * 
     * @return bool Failed or success?
     */
    public static function up(int $id): bool
    {
        if (isset($id) && !$id == null) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Stop an unit test
     * 
     * @param int $id
     * 
     * @return bool Failed or success?
     */
    public static function down(int $id): bool
    {
        if (isset($id) && !$id == null) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check if a unit test failed or not
     * 
     * @param int $id 
     * 
     * @return bool Failed or success?
     */
    public static function check(int $id) : bool {
        if (isset($id) && !$id == null) {
            return true;
        } else {
            return false;
        }
    }
}