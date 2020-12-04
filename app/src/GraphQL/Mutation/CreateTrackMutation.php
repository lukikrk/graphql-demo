<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Entity\Track;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Ramsey\Uuid\Uuid;

class CreateTrackMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var AlbumRepository
     */
    private AlbumRepository $albumRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param AlbumRepository $albumRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(AlbumRepository $albumRepository, EntityManagerInterface $em)
    {
        $this->albumRepository = $albumRepository;
        $this->em = $em;
    }

    /**
     * @param Argument $args
     *
     * @return Track
     *
     * @throws \Exception
     */
    public function create(Argument $args): Track
    {
        $track = new Track(
            Uuid::uuid4(),
            $args['input']['name'],
            $args['input']['position'],
            $args['input']['length'],
            $this->albumRepository->find($args['input']['album'])
        );

        $this->em->persist($track);
        $this->em->flush();

        return $track;
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['create' => 'create_track'];
    }
}
