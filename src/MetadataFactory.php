<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/metadata
 * @link https://github.com/Koudela/eArc-metadata/
 * @copyright Copyright (c) 2019 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\Metadata;

use function eArc\Metadata\events\components\earc_metadata\getClassName;
use eArc\Data\Interfaces\Persistence\PersistableDataInterface;
use eArc\Metadata\Interfaces\Application\MetadataInterface;

/**
 * Metadata factory class.
 */
class MetadataFactory
{
    /**
     * @inheritdoc
     */
    public function make(PersistableDataInterface $persistableData)
    {
        $metadataClass = getClassName(MetadataInterface::class);

        return new $metadataClass($persistableData);
    }
}