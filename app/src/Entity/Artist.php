<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Artist
{
    /**
     * @var UuidInterface
     */
    private UuidInterface $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Collection
     */
    private Collection $albums;

    /**
     * @param UuidInterface $id
     * @param string $name
     */
    public function __construct(UuidInterface $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->albums = new ArrayCollection();
    }

    /**
     * @param string $name
     */
    public function update(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return UuidInterface
     */
    public function id(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function albums(): Collection
    {
        return $this->albums;
    }
}
