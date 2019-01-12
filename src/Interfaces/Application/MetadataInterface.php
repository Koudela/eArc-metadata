<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/metadata
 * @link https://github.com/Koudela/eArc-metadata/
 * @copyright Copyright (c) 2019 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\Metadata\Interfaces\Application;

use eArc\Data\Interfaces\Persistence\PersistableDataInterface;

/**
 * Metadata interface.
 */
interface MetadataInterface
{
    /**
     * Get the identifier of the object/data. A string that is unique to the
     * type of object/data. May return null if the persisted data the object
     * belongs to does not exist yet.
     *
     * @return string|null
     */
    public function getIdentifier(): ?string;

    /**
     * Get the value of the metadatum.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Set the value of the metadatum.
     *
     * @param mixed $data
     */
    public function setValue($data): void;

    /**
     * Get the name of the metadatum.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the class name of the related object.
     *
     * @return string
     */
    public function getRelatedObjectClass(): string;

    /**
     * Get the identifier of the related object.
     *
     * @return string
     */
    public function getRelatedObjectIdentifier(): string;

    /**
     * Expose the persistable part of the object. (Warning: Do not use this
     * method in the application context.)
     *
     * @return PersistableDataInterface
     */
    public function expose(): PersistableDataInterface;
}
