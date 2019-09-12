<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\Movie\Helper;

use Magento\Framework\DB\DataConverter\DataConversionException;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\Serializer\Serialize;
use Magento\Framework\DB\DataConverter\DataConverterInterface;
/**
 * Convert from serialized to JSON format
 */
class JsonToSerialized implements DataConverterInterface
{
    /**
     * @var Serialize
     */
    private $serialize;

    /**
     * @var Json
     */
    private $json;

    /**
     * Constructor
     *
     * @param Serialize $serialize
     * @param Json $json
     */

    public function __construct(
        Serialize $serialize,
        Json $json
    )
    {
        $this->serialize = $serialize;
        $this->json = $json;
    }
    public function convert($value)
    {
        if ($this->isSerializeString($value)) {
            $value = $this->json->serialize($value);
        }
        return $this->serializedValue(($this->decodeValue($value)));
    }
    protected function decodeValue($value){
        $storedPrecision = ini_get('precision');
        $storedSerializePrecision = ini_get('serialize_precision');

        if (PHP_VERSION_ID < 70100) {
            // In PHP version < 7.1.0 json_encode() uses EG(precision).
            ini_set('precision', 17);
        } else {
            // In PHP version >= 7.1.0 json_encode() uses PG(serialize_precision).
            ini_set('serialize_precision', 17);
        }
        $value = $this->json->unserialize($value);

        ini_set('precision', $storedPrecision);
        ini_set('serialize_precision', $storedSerializePrecision);

        if (json_last_error()) {
            throw new DataConversionException(json_last_error_msg());
        }
        return $value;
    }
    protected function serializedValue($value){
        try {
            set_error_handler(function ($errorNumber, $errorString) {
                throw new DataConversionException($errorString, $errorNumber);
            });
            $value = $this->serialize->serialize($value);
        } catch (\Throwable $throwable) {
            throw new DataConversionException($throwable->getMessage());
        } finally {
            restore_error_handler();
        }
        return $value;
    }
    protected function isSerializeString($value){
        // Bit of a give away this one
        if (!is_string($value))
        {
            return false;
        }
        // Serialized false, return true. unserialize() returns false on an
        // invalid string or it could return false if the string is serialized
        // false, eliminate that possibility.
        if ($value === 'b:0;')
        {
            $result = false;
            return true;
        }
        $length = strlen($value);
        $end    = '';
        switch ($value[0])
        {
            case 's':
                if ($value[$length - 2] !== '"')
                {
                    return false;
                }
            case 'b':
            case 'i':
            case 'd':
                // This looks odd but it is quicker than isset()ing
                $end .= ';';
            case 'a':
            case 'O':
                $end .= '}';
                if ($value[1] !== ':')
                {
                    return false;
                }
                switch ($value[2])
                {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                        break;
                    default:
                        return false;
                }
            case 'N':
                $end .= ';';
                if ($value[$length - 1] !== $end[0])
                {
                    return false;
                }
                break;
            default:
                return false;
        }
        if (($result = @unserialize($value)) === false)
        {
            $result = null;
            return false;
        }
        return true;
    }
}
