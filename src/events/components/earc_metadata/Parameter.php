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

use eArc\EventTree\Event;
use eArc\EventTree\Interfaces\EventListenerInterface;

/**
 * Defines parameter used by earc/metadata.
 */
class Parameter implements EventListenerInterface
{
    const EARC_LISTENER_PATIENCE = -10;

    const EARC_LISTENER_COMPONENT_DEPENDENCIES = [];

    /**
     * @inheritdoc
     */
    public function process(Event $event)
    {
        return [
        ];
    }
}
