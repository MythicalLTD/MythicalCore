<?php

namespace MythicalSystems\Helpers;

/**
 * Class ConfigHelper
 * @package MythicalSystems\Helpers
 */
class ConfigHelper
{

    private string $configPath;
    private array $configData;

    /**
     * ConfigHelper constructor.
     * @param string $configFile The path to the configuration file.
     */
    public function __construct(string $configFile)
    {
        $this->configPath = $configFile;
        $this->configData = $this->readConfig();
    }

    /**
     * Get a value from the configuration file.
     *
     * @param string $section The section in the configuration file.
     * @param string $key The key within the section.
     * @return string|null The value associated with the key, or null if not found.
     */
    public function get(string $section, string $key): ?string
    {
        return $this->configData[$section][$key] ?? null;
    }

    /**
     * Set a value in the configuration file.
     *
     * @param string $section The section in the configuration file.
     * @param string $key The key within the section.
     * @param string $value The value to set.
     * @return bool True if the operation succeeded, false otherwise.
     */
    public function set(string $section, string $key, string $value): bool
    {
        $this->configData[$section][$key] = $value;
        return $this->writeConfig();
    }

    /**
     * Add a new section or key-value pair in the configuration file.
     *
     * @param string $section The section in the configuration file.
     * @param string $key The key within the section.
     * @param string $value The value to set.
     * @return bool True if the operation succeeded, false otherwise.
     */
    public function add(string $section, string $key, string $value): bool
    {
        if (!isset($this->configData[$section])) {
            $this->configData[$section] = [];
        }
        $this->configData[$section][$key] = $value;
        return $this->writeConfig();
    }

    /**
     * Remove a section or key from the configuration file.
     *
     * @param string $section The section in the configuration file.
     * @param string|null $key (Optional) The key within the section to remove. If null, the entire section will be removed.
     * @return bool True if the operation succeeded, false otherwise.
     */
    public function remove(string $section, ?string $key = null): bool
    {
        if ($key === null) {
            unset($this->configData[$section]);
        } else {
            unset($this->configData[$section][$key]);
        }
        return $this->writeConfig();
    }

    /**
     * Read the configuration file.
     *
     * @return array The parsed configuration data.
     */
    private function readConfig(): array
    {
        $config = file_get_contents($this->configPath);
        return json_decode($config, true) ?: [];
    }

    /**
     * Write the configuration file.
     *
     * @return bool True if the operation succeeded, false otherwise.
     */
    private function writeConfig(): bool
    {
        $jsonConfig = json_encode($this->configData, JSON_PRETTY_PRINT);
        return file_put_contents($this->configPath, $jsonConfig) !== false;
    }

}
?>