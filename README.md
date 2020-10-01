# emLogger Utility

This is a utility logging external module.  It is intended to be enabled on your server and configured with a physical directory where the log files will be saved.  We use this on many of our external modules so we can easily track logs without clogging the REDCap logs.

A module that uses the emLogger should 'fail gracefully' - meaning that if you do not have this module enabled on your server, it should behave as it normally would but just not log.

## Configuring

Upon enabling this external module you must configure it with:
  * path where all logs will be stored (e.g. `/var/log/redcap/`)
  * turn on/off TSV logging
  * turn on/off json logging - we use splunk and the json-level logging can be easily indexed and searched


## Usage

This module is actually used by other external modules.  If the other module was already built to use this, there isn't much of anything you need to do.  In the other module there may be options to control the logging levels.

If you are building a new module and want to add emLogger to it, follow these directions:

### Building External Modules to use EmLogger

It is useful to wrap this logging function around an external module's own primary class.  Lately we have been doing that with a 'trait'.  
* **Step 1** copy the `emLoggerTrait.php` file located in this module to your external module.
* **Step 2** edit the `emLoggerTrait.php` file to fix the namespace
* **Step 3** In your EM, add an include_once to load the trait.
* **Step 4** As soon as your class is defined, add `use emLoggerTrait` (see below)

```php
include_once "emLoggerTrait.php";

class myEM extends \ExternalModules\AbstractExternalModule {
    use emLoggerTrait

    // your normal EM class    
}
```

This will add three methods to your class:
 
 `$this->emLog(...)`
 `$this->emDebug(...)`
 `$this->emError(...)`


These methods support an arbitrary number of arguments so you can log many variables in a single call including objects and arrays, eg:

```php
$q = REDCap::getData('array',..);
$this-emDebug("Loaded data", $q);`
```


emLog and emError are always written to log file.  If you wish to enable 'debug' logging (which is normally turned off) - you can add these options to your EM's config.json file so end-users can turn this level of logging on or off. For example, add these two system and project-level settings:

```json
  "system-settings": [
    {
      "key": "enable-system-debug-logging",
      "name": "<b>Enable Debug Logging (system-wide)</b> <i>(Requires emLogger)</i>",
      "required": false,
      "type": "checkbox"
    }
  ],

  "project-settings": [
    {
      "key": "enable-project-debug-logging",
      "name": "<b>Enable Debug Logging</b> <i>(Requires emLogger)</i>",
      "required": false,
      "type": "checkbox"
    }
   ],
```

The intention was to use emDebug for most logging when writing a new module.  When you move to production or release the module, these will not be turned on be default.  If there is an issue in the future, you can turn debug logging back on and you have all of your data...

### Future Ideas

* In the future, I've thought about added an email alert if any emError log entries are posted to notify the super user.  
* Currently each EM is making its own instance of this - it really should be shared but haven't gotten that far...
