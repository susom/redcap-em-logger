<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/endpoint.proto

namespace GPBMetadata\Google\Api;

class Endpoint
{
    public static $is_initialized = false;

    public static function initOnce()
    {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
            return;
        }
        \GPBMetadata\Google\Api\Annotations::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0a81020a19676f6f676c652f6170692f656e64706f696e742e70726f746f" .
            "120a676f6f676c652e617069225f0a08456e64706f696e74120c0a046e61" .
            "6d65180120012809120f0a07616c696173657318022003280912100a0866" .
            "65617475726573180420032809120e0a0674617267657418652001280912" .
            "120a0a616c6c6f775f636f7273180520012808426f0a0e636f6d2e676f6f" .
            "676c652e617069420d456e64706f696e7450726f746f50015a45676f6f67" .
            "6c652e676f6c616e672e6f72672f67656e70726f746f2f676f6f676c6561" .
            "7069732f6170692f73657276696365636f6e6669673b7365727669636563" .
            "6f6e666967a2020447415049620670726f746f33"
        ), true);

        static::$is_initialized = true;
    }
}
