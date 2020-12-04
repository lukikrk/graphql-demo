<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Album
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
     * @var int
     */
    private int $year;

    /**
     * @var Artist
     */
    private Artist $artist;

    /**
     * @var Collection
     */
    private Collection $tracks;

    /**
     * @param UuidInterface $id
     * @param string $name
     * @param int $year
     * @param Artist $artist
     */
    public function __construct(UuidInterface $id, string $name, int $year, Artist $artist)
    {
        $this->id = $id;
        $this->name = $name;
        $this->year = $year;
        $this->artist = $artist;
        $this->tracks = new ArrayCollection();
    }

    /**
     * @param string $name
     * @param int $year
     * @param Artist $artist
     */
    public function update(string $name, int $year, Artist $artist): void
    {
        $this->name = $name;
        $this->year = $year;
        $this->artist = $artist;
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
     * @return int
     */
    public function year(): int
    {
        return $this->year;
    }

    /**
     * @return Artist
     */
    public function artist(): Artist
    {
        return $this->artist;
    }

    /**
     * @return Collection
     */
    public function tracks(): Collection
    {
        return $this->tracks;
    }
}
