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

use eArc\Data\Interfaces\Exceptions\NoDataExceptionInterface;
use eArc\Data\Interfaces\Exceptions\DataExistsExceptionInterface;

/**
 * Metadata repository interface.
 */
interface MetadataRepositoryInterface
{
    /**
     * Get the metadatum linked by related object and name.
     *
     * @param object $relatedObject
     * @param string $name
     *
     * @return MetadataInterface
     *
     * @throws NoDataExceptionInterface
     */
    public function find(object $relatedObject, string $name): MetadataInterface;

    /**
     * Get all persisted metadata that exists for the related object.
     *
     * @param object $relatedObject
     *
     * @return MetadataInterface[]
     */
    public function findAll(object $relatedObject): array;

    /**
     * Create a metadatum for the pair of related object and metadata name.
     *
     * @param object $relatedObject
     * @param string $name
     *
     * @return MetadataInterface
     *
     * @throws DataExistsExceptionInterface
     */
    public function create(object $relatedObject, string $name): MetadataInterface;

    /**
     * Update the persisted metadatum the object belongs to.
     *
     * @param MetadataInterface $data
     *
     * @throws NoDataExceptionInterface
     */
    public function update(MetadataInterface $data): void;

    /**
     * Delete the persisted metadatum the identifier relates to.
     *
     * @param string $identifier
     */
    public function delete(string $identifier): void;

    /**
     * Update the persisted metadata the objects belong to.
     *
     * @param MetadataInterface[] $metadataObjects
     *
     * @throws NoDataExceptionInterface
     */
    public function batchUpdate(array $metadataObjects): void;

    /**
     * Delete the persisted metadata the identifiers relate to.
     *
     * @param string[] $identifiers
     */
    public function batchDelete(array $identifiers): void;
}
