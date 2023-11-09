<?php

namespace Stanford\emLogger;

# Includes the autoloader for libraries installed with composer
//require __DIR__ . '/vendor/autoload.php';

# Imports the Google Cloud client library
//use Google\Cloud\Logging\LoggingClient;

// commit just to trigger travis build.

class emLogger extends \ExternalModules\AbstractExternalModule
{
    private $log_json;
    private $log_tsv;
    private $single_file;        // If set, all logs will output to a single file - emLogger.tsv or emLogger.json
    private $base_server_path;
    private $ts_start;

    private $gcp_project_id;
    private $gcp_logging_resources;
    private $gcpLogger;             // Google logger client if enabled
    private $gcpLoggerResources;

    private $first_message = true;

    function __construct()
    {
        parent::__construct();

        // TEST COMMIT
        //$settings = $this->getSystemSettings('em_logger');
        $settings = $this->getSystemSettings();

        $this->ts_start = microtime(true);

        $this->log_json = $settings['log-json']['system_value'];
        $this->log_tsv = $settings['log-tsv']['system_value'];
        $this->single_file = $settings['single-file']['system_value'];
        $this->base_server_path = $settings['base-server-path']['system_value'];

        if(isset($settings['gcp-project-id'])){
            $this->gcp_project_id = $settings['gcp-project-id']['system_value'];
        }

        if(isset($settings['gcp-logging-resources'])){
            $this->gcp_logging_resources = json_decode($settings['gcp-logging-resources']['system_value'], true);
        }

//        if (!empty($this->gcp_project_id) && !empty($this->gcp_logging_resources)) {
////            $this->gcpLogger = new LoggingClient([
////                'projectId' => $this->gcp_project_id
////            ]);
////
////            $this->gcpLoggerResources = $this->gcp_logging_resources;
//        }
    }


    public function redcap_module_save_configuration($project_id = null)
    {
        // Try saving
        $this->emLog("emLogger", "Configuration Updated", "INFO", false);
    }


    /**
     * Is the payload string a valid JSON object
     * @param $string
     * @return bool
     */
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }


    /**
     * A utility logging function
     * @param        $file_prefix (will be combined with the system base-server-path to build a complete filename
     * @param        $args (must be a single variable - use an array to pass many variables at once)
     * @param string $type (logging level: INFO / DEBUG / ERROR)
     * @param null $fix_backtrace (optional parameter to assist when nesting logging functions)
     * @throws \Exception
     */
    function emLog($file_prefix, $args, $type = "INFO", $fix_backtrace = null, $flags = FILE_APPEND)
    {

        // FILENAME
        if ($this->single_file) {
            $filename = $this->base_server_path . "emLogger";
        } else {
            $filename = $this->base_server_path . $file_prefix;
        }

        // BACKTRACE (remove one from this logging class)
        $bt = debug_backtrace(2);

        // FIX START OF BACKTRACE
        /*  In cases where you call this log function from a parent object's log function, you really are interested
            in the backtrace from one level higher.  To make the logic work, we strip off the last backtrace array
            element.  If, on the other hand, you simply instantiate this and call it from a script, you will not need
            to strip.  There is a caveat - if you wrap your script with a function called log/debug/error it may
            erroneously strip a backtrace and leave your line number and calling function incorrect.

            To summarize, if you wrap this in a parent object, call it with methods 'log,debug, or error' and everything
            should work.

            If you do not specify the 4th argument, we 'guess' if we should fix the backtrace by looking at the name
            of the function 1 level up
        */
        if (isset($bt[1]["function"])
            && in_array($bt[1]['function'], array("log", "debug", "error", "emLog", "emDebug", "emError"))
            && is_null($fix_backtrace)) $fix_backtrace = true;
        if ($fix_backtrace) array_shift($bt);

        // PARSE BACKTRACE
        $function = isset($bt[1]['function']) ? $bt[1]['function'] : "";
        $file = isset($bt[0]['file']) ? $bt[0]['file'] : "";
        $line = isset($bt[0]['line']) ? $bt[0]['line'] : "";

        // DETERMINE TIME
        $runtime = round((microtime(true) - $this->ts_start) * 1000, 0);
        $date = date('Y-m-d H:i:s');

        // DETERMINE PROJECT ID
        global $project_id;
        $pid = isset($_GET['pid']) ? $_GET['pid'] : (empty($project_id) ? "-" : $project_id);

        // DETERMINE USERNAME
        //$username = \ExternalModules\ExternalModules::getUsername();
        $username = defined('USERID') ? USERID : "";
        if (empty($username)) $username = "-";


        // PARSE ARGUMENTS:
        // Convert into an array in the event someone passes a string or other variable type
        if (!is_array($args)) $args = array($args);

        if ($this->log_json) {
            // Add context to args
            $args_detail = [];
            $i = 1;
            foreach ($args as $arg) {
                $detail = [];

                $arg_type = gettype($arg);
                if ($arg_type == "string") {
                    if ($this->isJson($arg)) {
                        // check for json
                        $arg_type = "json";
                        $arg = json_decode($arg);
                    }
                }
                $detail['type'] = $arg_type;
                $detail['value'] = $arg;

                if (count($args) > 1) {
                    $detail['count'] = $i;
                }

                $args_detail[] = $detail;
                $i++;
            }

            // if log has multiple messages loop over each element and concat the value to message attribute.
            $temp_message = '';
            foreach ($args_detail as $item){
                // serialize stdClass and array.
                if(gettype($item['value']) == 'object' || gettype($item['value']) == 'array'){
                    $temp_message .= json_encode($item['value']) . ' ,';
                }else{
                    $temp_message .= $item['value'] . ' ,';
                }
            }

            $temp_message = rtrim($temp_message, ',');

            
            $entry = array(
                "date" => $date,
                "process" => getmypid(),
                "type" => $type,
                "pid" => $pid,
                "username" => $username,
                "args" => $args_detail,
                "message" => $temp_message,
                "file" => $file,
                "line" => $line,
                "function" => $function,
                "sourceIP" => $this->getIP(),
                "runtime" => $runtime,
                "desc" => "external_module",
                "external_module_name" => $this->getFilePrefix($filename)
            );

            // Add the prefix in single-file mode
            if ($this->single_file) $entry['prefix'] = $file_prefix;

            if ($type == "ERROR") $entry['backtrace'] = $bt;

            $file_suffix = ".json";
            $log = json_encode($entry) . "\n";

            // WRITE TO FILE
            $this->write($filename . $file_suffix, $log, $flags, $type);
        } //json


        if ($this->log_tsv) {
            $entries = array();

            $count = count($args);
            foreach ($args as $i => $message) {

                // Convert arrays/objects into string for logging
                if (is_array($message)) {
                    $obj = "ARR";
                    $msg = empty($message) ? "()" : print_r($message, true);
                } elseif (is_object($message)) {
                    $obj = "OBJ";
                    $msg = print_r($message, true);
                } elseif (is_string($message) || is_numeric($message)) {
                    $obj = "STR";
                    $msg = $message;
                } elseif (is_bool($message)) {
                    $obj = "BOOL";
                    $msg = ($message ? "true" : "false");
                } elseif (is_null($message)) {
                    $obj = "NULL";
                    $msg = "";
                } else {
                    $obj = "UNK";
                    $msg = print_r($message, true);
                }

                $entry = array(
                    "date" => $date,
                    "process" => getmypid(),
                    "prefix" => $file_prefix,
                    "type" => $type,
                    "ms" => sprintf('%4s', $runtime),
                    "pid" => $pid,
                    "username" => $username,
                    "file" => basename($file, '.php'),
                    "line" => $line,
                    "function" => $function,
                    "sourceIP" => $this->getIP(),
                    "arg" => "[" . ($i + 1) . "/" . $count . "]",
                    "obj" => $obj,
                    "msg" => $msg
                );

                if (!$this->single_file) unset($entry["prefix"]);
                $entries[] = implode("\t", $entry);
            } // loop
            $file_suffix = ".log";

            if ($this->first_message) {
                $log = "\n";
                $this->first_message = false;
            } else {
                $log = "";
            }

            $log .= implode("\n", $entries) . "\n";

            // WRITE TO FILE
            $this->write($filename . $file_suffix, $log, $flags, $type);
        } // tsv

    } // log

    /**
     * Google Cloud logging options
     * @param $filename
     * @return mixed|string
     */
    public function getFilePrefix($filename)
    {
        $parts = explode('/', $filename);
        $filename = explode('.', end($parts));
        return $filename[0];
    }

    public function getIP()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            //check for ip from share internet
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            // Check for the Proxy User
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        return $ip;
    }

    function write($filename, $data, $flags, $type = 'INFO')
    {
        // Default emLogger File output
        if (is_writable($filename) || is_writable(dirname($filename))) {
            file_put_contents($filename, $data, $flags);
        } else {
            throw new \Exception ("Unable to write emLogger to $filename - is the directory writable?");
        }

//        // Try GCP Cloud option if enabled
//        if (!empty($this->gcp_project_id)) {
//            try {
//                $name = $this->getFilePrefix($filename);
//                if ($this->log_tsv) {
//                    $rows = explode("\n", $data);
//
//                    foreach ($rows as $row) {
//                        if (!$row) {
//                            continue;
//                        }
//                        if (is_string($row) && $this->isJson($row)) {
//                            $entry = json_decode($data, true);
//                        } else {
//                            $entry = $row;
//                        }
//
//                        $this->gcpLoggerResources['severity'] = $type;
//                        $this->gcpLoggerResources['resource']['labels']['container_name'] = $name;
//                        $this->gcpLoggerResources['resource']['labels']['source'] = $this->getIP();
//                        $logger = $this->gcpLogger->logger($name, $this->gcpLoggerResources);
//                        $e = $logger->entry($entry, $this->gcpLoggerResources);
//                        $logger->write($e);
//                    }
//                } elseif ($this->log_json) {
//                    $entry = json_decode($data, true);
//                    $this->gcpLoggerResources['resource']['labels']['container_name'] = $name;
//                    $this->gcpLoggerResources['resource']['labels']['source'] = $this->getIP();
//                    $this->gcpLoggerResources['severity'] = $type;
//                    $logger = $this->gcpLogger->logger($name, $this->gcpLoggerResources);
//                    $entry = $logger->entry($entry, $this->gcpLoggerResources);
//                    $logger->write($entry);
//                }
//            } catch (\Exception $e) {
//                echo $e->getMessage();
//            }
//        }
    }


    /**
     * Feature to truncate large files if needed.
     * TODO: Does this only apply to google loggins?
     * @param $cron
     * @return void
     * @throws \Exception
     */
    public function truncateLogsCron($cron)
    {
        if ($this->single_file) {
            $this->emLog($this->PREFIX, "About to truncate log - to disable edit the emLogger configuration");
            sleep(30);  // Give the log parser a chance to detect this log entry...
            $this->emLog($this->PREFIX, "Logs Truncated - to disable edit the emLogger configuration", "INFO", false, 0);
        }
    }

} // class
