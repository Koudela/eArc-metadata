<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/metadata
 * @link https://github.com/Koudela/eArc-metadata/
 * @copyright Copyright (c) 2019 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\Metadata\Exceptions;

use eArc\Metadata\Interfaces\Exceptions\MetadataExceptionInterface;

/**
 * Generic metadata exception.
 */
class MetadataException extends \RuntimeException implements MetadataExceptionInterface
{
}
