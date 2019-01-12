<?php
/**
 * e-Arc Framework - the explicit Architecture Framework
 *
 * @package earc/metadata
 * @link https://github.com/Koudela/eArc-metadata/
 * @copyright Copyright (c) 2019 Thomas Koudela
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace eArc\Data;

use eArc\Data\Interfaces\Application\DataInterface;
use eArc\Data\Interfaces\Application\DataRepositoryInterface;
use eArc\Metadata\Interfaces\Application\MetadataInterface;
use eArc\Metadata\Interfaces\Application\MetadataRepositoryInterface;
use eArc\Metadata\Interfaces\Persistence\MetadataFactoryInterface;

/**
 * Metadata repository.
 */
class MetadataRepository implements MetadataRepositoryInterface
{
    /** @var MetadataFactoryInterface */
    protected $metadataFactory;

    /** @var DataRepositoryInterface */
    protected $dataRepository;

    /** @var string */
    protected $path;

    /** @var DataInterface[] */
    protected $data = [];

    public function __construct(
        MetadataFactoryInterface $metadataFactory,
        DataRepositoryInterface $dataRepository,
        string $pathVarData)
    {
        $this->metadataFactory = $metadataFactory;
        $this->dataRepository = $dataRepository;
        $this->path = $pathVarData;
    }

    /**
     * @inheritdoc
     */
    public function find(object $relatedObject, string $name): MetadataInterface
    {
        $identifier = $this->getIdentifier($relatedObject, $name);

        if (!isset($this->data[$identifier])) {
            $this->data[$identifier] = $this->dataRepository->find($identifier);
        }

        return $this->metadataFactory->make($this->data[$identifier]->expose());
    }

    /**
     * @inheritdoc
     */
    public function findAll(object $relatedObject): array
    {
        $data = [];
        $matches = [];

        foreach(scandir($this->path) as $file) {
            if (preg_match(
                sprintf(
                    '/^(earc_metadata\+%s\+%s\+[a-zA-Z0-9_]+)\.data$/',
                    preg_quote(get_class($relatedObject), '/'),
                    preg_quote($relatedObject->getIdentifier(), '/')
                ),
                $file,
                $matches
            )) {
                $identifier = $matches[1];
                if (!isset($data[$identifier])) {
                    if (!isset($this->data[$identifier])) {
                        $this->data[$identifier] = $this->dataRepository
                            ->find($identifier);
                    }
                    $data[$identifier] = $this->metadataFactory
                        ->make($this->data[$identifier]->expose());
                }
            }
        }

        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function create(object $relatedObject, string $name): MetadataInterface
    {
        $identifier = $this->getIdentifier($relatedObject, $name);

        $this->data[$identifier] = $this->dataRepository->create($identifier);

        return $this->metadataFactory->make($this->data[$identifier]->expose());
    }

    /**
     * @inheritdoc
     */
    public function update(MetadataInterface $metadata): void
    {
        $this->dataRepository->update($this->data[$metadata->getIdentifier()]);
    }

    /**
     * @inheritdoc
     */
    public function delete(string $identifier): void
    {
        $this->dataRepository->delete($identifier);
    }

    /**
     * @inheritdoc
     */
    public function batchUpdate(array $metadataObjects): void
    {
        foreach ($metadataObjects as $metadata) {
            $this->dataRepository->update($this->data[$metadata->getIdentifier()]);
        }
    }

    /**
     * @inheritdoc
     */
    public function batchDelete(array $identifiers): void
    {
        foreach ($identifiers as $identifier) {
            $this->dataRepository->delete($identifier);
        }
    }

    /**
     * Get the identifier for an object name pair.
     *
     * @param object $relatedObject
     * @param string $name
     *
     * @return string
     */
    protected function getIdentifier(object $relatedObject, string $name): string
    {
        return sprintf('earc_metadata+%s+%s+%s',
            str_replace('\\', '-', get_class($relatedObject)),
            $relatedObject->getIdentifier(),
            $name
        );
    }
}
