<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/logging/v2/logging.proto

namespace Google\Cloud\Logging\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Result returned from ListLogs.
 *
 * Generated from protobuf message <code>google.logging.v2.ListLogsResponse</code>
 */
class ListLogsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * A list of log names. For example,
     * `"projects/my-project/logs/syslog"` or
     * `"organizations/123/logs/cloudresourcemanager.googleapis.com%2Factivity"`.
     *
     * Generated from protobuf field <code>repeated string log_names = 3;</code>
     */
    private $log_names;
    /**
     * If there might be more results than those appearing in this response, then
     * `nextPageToken` is included.  To get the next set of results, call this
     * method again using the value of `nextPageToken` as `pageToken`.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     */
    private $next_page_token = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     * @type string[]|\Google\Protobuf\Internal\RepeatedField $log_names
     *           A list of log names. For example,
     *           `"projects/my-project/logs/syslog"` or
     *           `"organizations/123/logs/cloudresourcemanager.googleapis.com%2Factivity"`.
     * @type string $next_page_token
     *           If there might be more results than those appearing in this response, then
     *           `nextPageToken` is included.  To get the next set of results, call this
     *           method again using the value of `nextPageToken` as `pageToken`.
     * }
     */
    public function __construct($data = NULL)
    {
        \GPBMetadata\Google\Logging\V2\Logging::initOnce();
        parent::__construct($data);
    }

    /**
     * A list of log names. For example,
     * `"projects/my-project/logs/syslog"` or
     * `"organizations/123/logs/cloudresourcemanager.googleapis.com%2Factivity"`.
     *
     * Generated from protobuf field <code>repeated string log_names = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLogNames()
    {
        return $this->log_names;
    }

    /**
     * A list of log names. For example,
     * `"projects/my-project/logs/syslog"` or
     * `"organizations/123/logs/cloudresourcemanager.googleapis.com%2Factivity"`.
     *
     * Generated from protobuf field <code>repeated string log_names = 3;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLogNames($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->log_names = $arr;

        return $this;
    }

    /**
     * If there might be more results than those appearing in this response, then
     * `nextPageToken` is included.  To get the next set of results, call this
     * method again using the value of `nextPageToken` as `pageToken`.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->next_page_token;
    }

    /**
     * If there might be more results than those appearing in this response, then
     * `nextPageToken` is included.  To get the next set of results, call this
     * method again using the value of `nextPageToken` as `pageToken`.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_page_token = $var;

        return $this;
    }

}
