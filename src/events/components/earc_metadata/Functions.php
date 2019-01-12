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

use function eArc\ComponentDI\events\components\earc_component_d_i\getClassName as getComponentDIClassName;
use eArc\ComponentDI\Interfaces\Exceptions\InvalidConfigurationExceptionInterface;
use eArc\ComponentDI\ComponentContainer;
use eArc\DI\Interfaces\ContainerInterface;
use eArc\EventTree\Event;
use eArc\EventTree\Interfaces\EventListenerInterface;

/**
 * Defines functions used by earc/metadata.
 */
class Functions implements EventListenerInterface
{
    const EARC_LISTENER_PATIENCE = -20;

    const EARC_LISTENER_COMPONENT_DEPENDENCIES = [];

    /**
     * @inheritdoc
     */
    public function process(Event $event)
    {
        global $earcDataEvent;

        $earcDataEvent = $event;

        if (!function_exists('\\eArc\\Data\\events\\components\\earc_metadata\\getComponentContainer'))
        {
            /**
             * Get the components container.
             *
             * @return ContainerInterface
             */
            function getComponentContainer(): ContainerInterface
            {
                /** @var Event $earcDataEvent */
                global $earcDataEvent;

                return $earcDataEvent->get(ComponentContainer::CONTAINER_BAG)->get('earc_metadata');
            }
        }

        if (!function_exists('\\eArc\\Data\\events\\components\\earc_metadata\\getClassName'))
        {
            /**
             * Get the class implementing the interface for the earc_metadata
             * component.
             *
             * @param string $interfaceName
             *
             * @return string
             */
            function getClassName(string $interfaceName): string
            {
                $className = getComponentContainer()->get($interfaceName);

                if (!is_subclass_of($className, $interfaceName)) {
                    $invalidConfigurationExceptionClass = getComponentDIClassName(
                        InvalidConfigurationExceptionInterface::class
                    );
                    throw new $invalidConfigurationExceptionClass(sprintf(
                        '`%s` has to implement `%s`',
                        $className,
                        $interfaceName
                    ));
                }

                return $className;
            }
        }

        return [];
    }
}
