<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/expr/v1beta1/eval.proto

namespace Google\Api\Expr\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A set of errors.
 * The errors included depend on the context. See `ExprValue.error`.
 *
 * Generated from protobuf message <code>google.api.expr.v1beta1.ErrorSet</code>
 */
class ErrorSet extends \Google\Protobuf\Internal\Message
{
    /**
     * The errors in the set.
     *
     * Generated from protobuf field <code>repeated .google.rpc.Status errors = 1;</code>
     */
    private $errors;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     * @type \Google\Rpc\Status[]|\Google\Protobuf\Internal\RepeatedField $errors
     *           The errors in the set.
     * }
     */
    public function __construct($data = NULL)
    {
        \GPBMetadata\Google\Api\Expr\V1Beta1\PBEval::initOnce();
        parent::__construct($data);
    }

    /**
     * The errors in the set.
     *
     * Generated from protobuf field <code>repeated .google.rpc.Status errors = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * The errors in the set.
     *
     * Generated from protobuf field <code>repeated .google.rpc.Status errors = 1;</code>
     * @param \Google\Rpc\Status[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setErrors($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Rpc\Status::class);
        $this->errors = $arr;

        return $this;
    }

}
