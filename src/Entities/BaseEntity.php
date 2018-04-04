<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 11.39
 */

namespace Quantox\Domain\Entities;

/**
 * Abstract Base Entity class for all Domain Entities.
 *
 * Implementation Entities should not need to call parent __construct() method, but they
 * should implement validate() method.
 *
 * Implementation Entities should also provide documented getters() for all class
 * attributes/fields, as well as provide the appropriate accessibility for all attributes.
 *
 * @package Quantox\Domain\Entities
 */
abstract class BaseEntity
{
    /**
     * Entity's ID.
     *
     * @var integer
     */
    protected $id = 0;

    /**
     * Initializes the Base Entity object.
     *
     * Loaded parameter should be an associative array, containing the list of
     * fields to be loaded into the Entity class.
     *
     * ID field should be present in the provided array of Entity's fields, as an Entity
     * has always an identity, and should be identified by an ID field.
     *
     * If no ID is supplied, a new/blank Entity is assumed.
     *
     * Will also load available class attributes with which ever value was supplied in the
     * field's array.
     *
     * @param array $fields - List of fields to be loaded into the class.
     *
     * @throws \InvalidArgumentException - If the supplied ID is not a positive integer.
     * @throws \UnderflowException       - If required fields are missing.
     *
     * @return void
     */
    public function __construct(array $fields)
    {
        // Validates the values for the Entity.
        if (!$this->validate($fields)) {
            throw new \UnderflowException("Necessary Entity fields were not supplied as parameters.");
        }

        // Loads other attribute values into the class.
        $this->loadInitialAttributeValues($fields);
    }

    /**
     * Autoloads the class' attributes, using the values supplied in <code>$fields</code>.
     *
     * Currently, if a field is supplied in <code>$fields</code>, but is not set as a class
     * attribute, it <b>will not be set</b> dynamically.
     *
     * @param  array $fields - Values to be set into the class' state.
     *
     * @since  1.0.0
     * @return void
     */
    private function loadInitialAttributeValues(array $fields): void
    {
        // Loads existing class attributes, if supplied in $fields.
        foreach (\get_object_vars($this) as $attribute => $value) {
            // Checks if the class property exists in the supplied fields.
            // If so, sets the value in the class.
            if (\array_key_exists($attribute, $fields)) {
                $this->$attribute = $fields[$attribute];
            }
        }
    }

    /**
     * Returns the <i>Entity</i>'s <b>record ID</b>.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Method used to validate that the supplied array of <code>$fields</code> being loaded
     * are <b>valid</b>.
     *
     * Implement this method in the implementation class of the <i>Entity</i>, and return <code>FALSE</code>
     * if any of the required fields is missing. Return <code>TRUE</code> otherwise.
     *
     * @param array $fields - Array of fields to be loaded into the <i>Entity</i>.
     *
     * @return bool
     */
    protected function validate(array $fields): bool
    {
        return true;
    }

    /**
     * Validates if all the supplied <code>$items</code> exist as keys in the <code>$origin</code> array.
     *
     * Returns <b>FALSE</b> if at least one doesn't exist. <b>TRUE</b> otherwise.
     *
     * @param  array $fields - Fields to validate.
     * @param  array $origin - Original array to test items against.
     *
     * @return bool
     */
    protected function validateIfAllFieldsExist(array $fields, array $origin): bool
    {
        // Loops through all the supplied items.
        foreach ($fields as $field) {
            //  Returns FALSE as soon as one doesn't exist.
            if (! \array_key_exists($field, $origin)) {
                return false;
            }
        }

        // Returns TRUE otherwise.
        return true;
    }

    /**
     * Retrieves a list containing all <i>Entity</i>'s fields.
     *
     * Returns an associative array containing all the fields from the <i>Entity</i>.
     *
     * Arrays will be returned as <code>JSON</code>.
     *
     * Other objects will either be returned as their <b>string</b> representation, or they will
     * be <i>serialized</i>.
     *
     * <i>Primitive types</i>, or <i>unserializable</i> objects, will be returned in their <i>native
     * form</i>.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        foreach (\get_object_vars($this) as $field => $value) {
            if (\method_exists($this->{$field}, '__toString')) {
                // Returns the string representation of the object?
                $attributes[$field] = $this->{$field}->__toString();
            } elseif (\is_array($this->{$field}) || \is_object($this->{$field})) {
                // Does if try to convert the value to JSON?
                $attributes[$field] = \json_encode($this->{$field});
            } else {
                // Or does it return the value in its native form?
                $attributes[$field] = $this->{$field};
            }
        }

        // Returns the attribute's list.
        return $attributes;
    }
}
