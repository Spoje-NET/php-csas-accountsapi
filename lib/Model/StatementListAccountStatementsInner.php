<?php

declare(strict_types=1);

/**
 * This file is part of the CSasWebApi package
 *
 * https://github.com/Spoje-NET/php-csas-webapi
 *
 * (c) SpojeNetIT <http://spoje.net/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Production Accounts API V3.
 *
 * API for managing production accounts.
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: vitezslav.dvorak@spojenet.cz
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.11.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace SpojeNET\CSas\Model;

use SpojeNET\CSas\ObjectSerializer;

/**
 * StatementListAccountStatementsInner Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @see     https://openapi-generator.tech
 *
 * @implements \ArrayAccess<string, mixed>
 */
class StatementListAccountStatementsInner implements \ArrayAccess, \JsonSerializable, ModelInterface
{
    public const DISCRIMINATOR = null;
    public const FORMATS_PDF = 'pdf';
    public const FORMATS_XML = 'xml';
    public const FORMATS_XML_DATA = 'xml-data';
    public const FORMATS_ABO_STANDARD = 'abo-standard';
    public const FORMATS_ABO_INTERNAL = 'abo-internal';
    public const FORMATS_ABO_STANDARD_EXTENDED = 'abo-standard-extended';
    public const FORMATS_ABO_INTERNAL_EXTENDED = 'abo-internal-extended';
    public const FORMATS_CSV_COMMA = 'csv-comma';
    public const FORMATS_CSV_SEMICOLON = 'csv-semicolon';
    public const FORMATS_MT940 = 'mt940';

    /**
     * The original name of the model.
     */
    protected static string $openAPIModelName = 'StatementList_accountStatements_inner';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static array $openAPITypes = [
        'accountStatementId' => 'string',
        'year' => 'float',
        'month' => 'float',
        'sequenceNumber' => 'float',
        'period' => '\SpojeNET\CSas\Model\GetAccountStatements200ResponseStatementsInnerPeriod',
        'formats' => 'string[]',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @var string[]
     *
     * @phpstan-var array<string, string|null>
     *
     * @psalm-var array<string, string|null>
     */
    protected static array $openAPIFormats = [
        'accountStatementId' => null,
        'year' => null,
        'month' => null,
        'sequenceNumber' => null,
        'period' => null,
        'formats' => null,
    ];

    /**
     * Array of nullable properties. Used for (de)serialization.
     *
     * @var bool[]
     */
    protected static array $openAPINullables = [
        'accountStatementId' => false,
        'year' => false,
        'month' => false,
        'sequenceNumber' => false,
        'period' => false,
        'formats' => false,
    ];

    /**
     * If a nullable field gets set to null, insert it here.
     *
     * @var bool[]
     */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static array $attributeMap = [
        'accountStatementId' => 'accountStatementId',
        'year' => 'year',
        'month' => 'month',
        'sequenceNumber' => 'sequenceNumber',
        'period' => 'period',
        'formats' => 'formats',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static array $setters = [
        'accountStatementId' => 'setAccountStatementId',
        'year' => 'setYear',
        'month' => 'setMonth',
        'sequenceNumber' => 'setSequenceNumber',
        'period' => 'setPeriod',
        'formats' => 'setFormats',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static array $getters = [
        'accountStatementId' => 'getAccountStatementId',
        'year' => 'getYear',
        'month' => 'getMonth',
        'sequenceNumber' => 'getSequenceNumber',
        'period' => 'getPeriod',
        'formats' => 'getFormats',
    ];

    /**
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected array $container = [];

    /**
     * Constructor.
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('accountStatementId', $data ?? [], null);
        $this->setIfExists('year', $data ?? [], null);
        $this->setIfExists('month', $data ?? [], null);
        $this->setIfExists('sequenceNumber', $data ?? [], null);
        $this->setIfExists('period', $data ?? [], null);
        $this->setIfExists('formats', $data ?? [], null);
    }

    /**
     * Gets the string presentation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            \JSON_PRETTY_PRINT,
        );
    }

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Checks if a property is nullable.
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     */
    public function isNullableSetToNull(string $property): bool
    {
        return \in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getFormatsAllowableValues()
    {
        return [
            self::FORMATS_PDF,
            self::FORMATS_XML,
            self::FORMATS_XML_DATA,
            self::FORMATS_ABO_STANDARD,
            self::FORMATS_ABO_INTERNAL,
            self::FORMATS_ABO_STANDARD_EXTENDED,
            self::FORMATS_ABO_INTERNAL_EXTENDED,
            self::FORMATS_CSV_COMMA,
            self::FORMATS_CSV_SEMICOLON,
            self::FORMATS_MT940,
        ];
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        return [];
    }

    /**
     * Validate all the properties in the model
     * return true if all passed.
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return \count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets accountStatementId.
     *
     * @return null|string
     */
    public function getAccountStatementId()
    {
        return $this->container['accountStatementId'];
    }

    /**
     * Sets accountStatementId.
     *
     * @param null|string $accountStatementId Unique identifier of the account statement
     *
     * @return self
     */
    public function setAccountStatementId($accountStatementId)
    {
        if (null === $accountStatementId) {
            throw new \InvalidArgumentException('non-nullable accountStatementId cannot be null');
        }

        $this->container['accountStatementId'] = $accountStatementId;

        return $this;
    }

    /**
     * Gets year.
     *
     * @return null|float
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year.
     *
     * @param null|float $year Year of the statement
     *
     * @return self
     */
    public function setYear($year)
    {
        if (null === $year) {
            throw new \InvalidArgumentException('non-nullable year cannot be null');
        }

        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets month.
     *
     * @return null|float
     */
    public function getMonth()
    {
        return $this->container['month'];
    }

    /**
     * Sets month.
     *
     * @param null|float $month Month of the statement
     *
     * @return self
     */
    public function setMonth($month)
    {
        if (null === $month) {
            throw new \InvalidArgumentException('non-nullable month cannot be null');
        }

        $this->container['month'] = $month;

        return $this;
    }

    /**
     * Gets sequenceNumber.
     *
     * @return null|float
     */
    public function getSequenceNumber()
    {
        return $this->container['sequenceNumber'];
    }

    /**
     * Sets sequenceNumber.
     *
     * @param null|float $sequenceNumber The account statement's sequence number
     *
     * @return self
     */
    public function setSequenceNumber($sequenceNumber)
    {
        if (null === $sequenceNumber) {
            throw new \InvalidArgumentException('non-nullable sequenceNumber cannot be null');
        }

        $this->container['sequenceNumber'] = $sequenceNumber;

        return $this;
    }

    /**
     * Gets period.
     *
     * @return null|\SpojeNET\CSas\Model\GetAccountStatements200ResponseStatementsInnerPeriod
     */
    public function getPeriod()
    {
        return $this->container['period'];
    }

    /**
     * Sets period.
     *
     * @param null|\SpojeNET\CSas\Model\GetAccountStatements200ResponseStatementsInnerPeriod $period period
     *
     * @return self
     */
    public function setPeriod($period)
    {
        if (null === $period) {
            throw new \InvalidArgumentException('non-nullable period cannot be null');
        }

        $this->container['period'] = $period;

        return $this;
    }

    /**
     * Gets formats.
     *
     * @return null|string[]
     */
    public function getFormats()
    {
        return $this->container['formats'];
    }

    /**
     * Sets formats.
     *
     * @param null|string[] $formats Available formats of the statement
     *
     * @return self
     */
    public function setFormats($formats)
    {
        if (null === $formats) {
            throw new \InvalidArgumentException('non-nullable formats cannot be null');
        }

        $allowedValues = $this->getFormatsAllowableValues();

        if (array_diff($formats, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'formats', must be one of '%s'",
                    implode("', '", $allowedValues),
                ),
            );
        }

        $this->container['formats'] = $formats;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
     *
     * @return null|mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param null|int $offset Offset
     * @param mixed    $value  Value to be set
     */
    public function offsetSet($offset, $value): void
    {
        if (null === $offset) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param int $offset Offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @see https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed returns data which can be serialized by json_encode(), which is a value
     *               of any type other than a resource
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets a header-safe presentation of the object.
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }

    /**
     * Array of nullable properties.
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null.
     *
     * @return bool[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null.
     *
     * @param bool[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
     * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
     * $this->openAPINullablesSetToNull array.
     *
     * @param mixed $defaultValue
     */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && \array_key_exists($variableName, $fields) && null === $fields[$variableName]) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }
}
