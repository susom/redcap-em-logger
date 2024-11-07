# emLogger Utility

This is a utility logging external module.  It is intended to be enabled on your server and configured by setting the file path to a physical directory where the log files will be saved.  Many external modules we have written will then use this module to centrally record logs.  This is helpful for debugging and for log analysis.

A module that uses the emLogger should 'fail gracefully' - meaning that if you do not have this module enabled on your server, it should behave as it normally would but just not log and entries.

## Configuring

Upon enabling this external module you must configure it on the system level with:
  * path where all logs will be stored (e.g. `/var/log/redcap/`)
  * turn on/off TSV logging
  * turn on/off json logging

You must enable either TSV or JSON logging or else no logs will be created.

### Single File Mode
To support easy scraping of log files using fluentd with kubernetes, we added an option that aggregates all log entries
into a single file with a new prefix attribute.  Optionally, if you use this mode, you can also enable a weekly cron
task that will erase your logs on a weekly basis.

### Enable Weekly Log Clearing
If checked and using single-file mode, a cron will clear out the log every sunday at midnight to prevent it from growing too large.  This is also designed for cases where you are shipping the logs to another server (e.g. splunk)

### GCP Logging
<< Documentation required >>

## Usage

This module is used by other external modules (typically written at Stanford).  If the other module was already built
 to use this, there isn't much of anything you need to do.  In the other modules should support configuration at either
 the system or project level to control the logging output.

If you are building a new module and want to add emLogger to it, follow these directions:

### Building External Modules to use EmLogger

It is useful to wrap this logging function around an external module's own primary class. Lately we have been doing that
with a 'trait'.

* **Step 1** copy the `emLoggerTrait.php` file located in this module to your external module.
* **Step 2** edit the `emLoggerTrait.php` file to fix the namespace at the top of the file (first 2 lines)
* **Step 3** In your EM, add an include_once to load the `emLoggerTrait.php` file into your module.
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
$this->emDebug("Loaded data", $q);`
```

emLog and emError are always written to log file.  If you wish to enable 'debug' logging (which is normally turned off) - you can add these options to your EM's config.json file so end-users can turn this level of logging on or off. For example, add these two system and project-level settings:

```json
{
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
  ]
}
```

The intention was to use emDebug for most logging when writing a new module.  When you move to production or release the module, these will not be turned on be default.  If there is an issue in the future, you can turn debug logging back on and you have all of your data...

## Future Ideas

* In the future, I've thought about added an email alert if any emError log entries are posted to notify the super user.
* Currently each EM is making its own instance of this - it really should be shared but haven't gotten that far...
