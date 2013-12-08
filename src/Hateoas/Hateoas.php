<?php

namespace Hateoas;

use Hateoas\Configuration\RelationsRepository;
use Hateoas\Helper\LinkHelper;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class Hateoas implements SerializerInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var RelationsRepository
     */
    private $relationsRepository;

    /**
     * @var LinkHelper
     */
    private $linkHelper;

    /**
     * @param SerializerInterface $serializer
     * @param RelationsRepository $RelationsRepository
     */
    public function __construct(SerializerInterface $serializer, RelationsRepository $relationsRepository, LinkHelper $linkHelper)
    {
        $this->serializer          = $serializer;
        $this->relationsRepository = $relationsRepository;
        $this->linkHelper          = $linkHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, $format, SerializationContext $context = null)
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, $type, $format, DeserializationContext $context = null)
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    /**
     * @return RelationsRepository
     */
    public function getRelationsRepository()
    {
        return $this->relationsRepository;
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * Gets the 'href' value of an object's link, identified by its rel name.
     *
     * @param object  $object
     * @param string  $rel
     * @param boolean $absolute
     *
     * @return string|null
     */
    public function getLinkHref($object, $rel, $absolute = false)
    {
        return $this->linkHelper->getLinkHref($object, $rel, $absolute);
    }
}
