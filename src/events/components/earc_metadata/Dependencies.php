<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/metadata
 * @link https://github.com/Koudela/eArc-metadata/
 * @copyright Copyright (c) 2019 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\Metadata\events\components\earc_metadata;

use eArc\Data\DataRepository;
use eArc\Data\MetadataRepository;
use eArc\EventTree\Event;
use eArc\EventTree\Interfaces\EventListenerInterface;
use eArc\Metadata\Exceptions\MetadataException;
use eArc\Metadata\Interfaces\Application\MetadataInterface;
use eArc\Metadata\Interfaces\Application\MetadataRepositoryInterface;
use eArc\Metadata\Interfaces\Exceptions\MetadataExceptionInterface;
use eArc\Metadata\Interfaces\Persistence\MetadataFactoryInterface;
use eArc\Metadata\Metadata;
use eArc\Metadata\MetadataFactory;

/**
 * Defines dependencies earc/metadata uses.
 */
class Dependencies implements EventListenerInterface
{
    const EARC_LISTENER_PATIENCE = 10;

    const EARC_LISTENER_COMPONENT_DEPENDENCIES = ['earc_data'];

    /**
     * @inheritdoc
     */
    public function process(Event $event)
    {
        return [
            MetadataRepository::class => [MetadataFactory::class, DataRepository::class, 'path.var.data'],

            MetadataFactory::class => [],

            MetadataInterface::class => Metadata::class,

            MetadataRepositoryInterface::class => MetadataRepository::class,

            MetadataExceptionInterface::class => MetadataException::class,

            MetadataFactoryInterface::class => MetadataFactory::class
        ];
    }
}
