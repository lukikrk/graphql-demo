<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Entity\Track;
use App\Repository\AlbumRepository;
use App\Repository\TrackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class UpdateTrackMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var TrackRepository
     */
    private TrackRepository $trackRepository;

    /**
     * @var AlbumRepository
     */
    private AlbumRepository $albumRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param TrackRepository $trackRepository
     * @param AlbumRepository $albumRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(TrackRepository $trackRepository, AlbumRepository $albumRepository, EntityManagerInterface $em)
    {
        $this->trackRepository = $trackRepository;
        $this->albumRepository = $albumRepository;
        $this->em = $em;
    }

    public function update(Argument $args): Track
    {
        $track = $this->trackRepository->find($args['id']);
        $track->update(
            $args['input']['name'],
            $args['input']['position'],
            $args['input']['length'],
            $this->albumRepository->find($args['input']['album'])
        );

        $this->em->flush();

        return $track;
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['update' => 'update_track'];
    }
}
