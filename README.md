# emLogger Utility

## Usage

Add the following methods to new external modules to enable easy and consistent logging:

Upon enabling this external module you must configure it with:
  * path where all logs will be stored (e.g. `/var/log/redcap/`)
  * turn on/off TSV logging
  * turn on/off json logging

You must instantiate this class before it can be used.  This is most easily done using a helper method from the ExternalModules class as:
```php
$emLogger = \ExternalModules\ExternalModules::getModuleInstance('em_logger');
```
This instance is shared across all external modules.  Each time it is called you must provide the context information that tell it where and how to log.
```php
/**
 * A utility logging function
 * @param        $file_prefix (will be combined with the system base-server-path to build a complete filename
 * @param        $args (must be a single variable - use an array to pass many variables at once)
 * @param string $type (logging level: INFO / DEBUG / ERROR)
 * @param null   $fix_backtrace (optional parameter to assist when nesting logging functions)
 */
function log($file_prefix, $args, $type = "INFO", $fix_backtrace = null)
```



### With External Modules

It is useful to wrap this logging function around an external module's own primary class.  The following code should be added to every new external module to add logging capability.  These methods support an arbitrary number of arguments so you can log many variables in a single call:
```php
class myEM extends \ExternalModules\AbstractExternalModule {


    function log() {
        $emLogger = \ExternalModules\ExternalModules::getModuleInstance('em_logger');
        $emLogger->log($this->PREFIX, func_get_args(), "INFO");
    }

    function debug() {
        // Check if debug enabled
        if ($this->getSystemSetting('enable-system-debug-logging') || $this->getProjectSetting('enable-project-debug-logging')) {
            $emLogger = \ExternalModules\ExternalModules::getModuleInstance('em_logger');
            $emLogger->log($this->PREFIX, func_get_args(), "DEBUG");
        }
    }

    function error() {
        $emLogger = \ExternalModules\ExternalModules::getModuleInstance('em_logger');
        $emLogger->log($this->PREFIX, func_get_args(), "ERROR");
    }
}
```

### With Plugin or DET Scripts
```php
// Assume you have redcap_connect.php previously included...

$emLogger = \ExternalModules\ExternalModules::getModuleInstance('em_logger');
$emLogger->log("my_plugin", $array_or_object, "INFO");
```