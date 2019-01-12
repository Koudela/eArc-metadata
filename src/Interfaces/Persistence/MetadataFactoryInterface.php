<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/metadata
 * @link https://github.com/Koudela/eArc-metadata/
 * @copyright Copyright (c) 2019 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\Metadata\Interfaces\Persistence;

use eArc\Data\Interfaces\Persistence\PersistableDataInterface;
use eArc\Metadata\Interfaces\Application\MetadataInterface;

/**
 * Metadata factory interface.
 */
interface MetadataFactoryInterface
{
    /**
     * Transforms the persistable data object into a metadata object.
     *
     * @param PersistableDataInterface $persistableData
     *
     * @return MetadataInterface
     */
    public function make(PersistableDataInterface $persistableData): MetadataInterface;
}