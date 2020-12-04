<?php

declare(strict_types=1);

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

class Track
{
    /**
     * @var UuidInterface
     */
    private  UuidInterface $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $position;

    /**
     * @var int
     */
    private int $length;

    /**
     * @var Album
     */
    private Album $album;

    /**
     * @param UuidInterface $id
     * @param string $name
     * @param int $position
     * @param int $length
     * @param Album $album
     */
    public function __construct(UuidInterface $id, string $name, int $position, int $length, Album $album)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->length = $length;
        $this->album = $album;
    }

    /**
     * @param string $name
     * @param int $position
     * @param int $length
     * @param Album $album
     */
    public function update(string $name, int $position, int $length, Album $album): void
    {
        $this->name = $name;
        $this->position = $position;
        $this->length = $length;
        $this->album = $album;
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
    public function position(): int
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return $this->length;
    }

    /**
     * @return Album
     */
    public function album(): Album
    {
        return $this->album;
    }
}
