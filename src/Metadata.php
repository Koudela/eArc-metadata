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
use eArc\Metadata\Interfaces\Exceptions\MetadataExceptionInterface;

/**
 * Metadata class.
 */
class Metadata implements MetadataInterface
{
    /** @var PersistableDataInterface */
    protected $persistableData;

    /** @var string */
    protected $name;

    /** @var string */
    protected $relatedObjectClass;

    /** @var string */
    protected $relatedObjectIdentifier;

    /**
     * @param PersistableDataInterface $persistableData
     */
    public function __construct(PersistableDataInterface $persistableData)
    {
        $this->persistableData = $persistableData;
        $matches = [];
        if (!preg_match(
            '/^earc_metadata\+([a-zA-Z0-9_\-]+)\+([a-zA-Z0-9_]+)\+([a-zA-Z0-9_]+)$/',
            $persistableData->getIdentifier(),
            $matches
        )) {
            $metadataException = getClassName(MetadataExceptionInterface::class);
            throw new $metadataException('Persistable data does not belong to a metadata object.');
        }
        $this->name = $matches[3];
        $this->relatedObjectClass = $matches[1];
        $this->relatedObjectIdentifier = $matches[2];
    }

    /**
     * @inheritdoc
     */
    public function getIdentifier(): string
    {
        return $this->persistableData->getIdentifier();
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->persistableData->get();
    }

    /**
     * @inheritdoc
     */
    public function setValue($data): void
    {
        $this->persistableData->set($data);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getRelatedObjectClass(): string
    {
        return $this->relatedObjectClass;
    }

    /**
     * @inheritdoc
     */
    public function getRelatedObjectIdentifier(): string
    {
        return $this->relatedObjectIdentifier;
    }

    /**
     * @inheritdoc
     */
    public function expose(): PersistableDataInterface
    {
        return $this->persistableData;
    }
}
