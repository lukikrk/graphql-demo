<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class UpdateAlbumMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var AlbumRepository
     */
    private AlbumRepository $albumRepository;

    /**
     * @var ArtistRepository
     */
    private ArtistRepository $artistRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param AlbumRepository $albumRepository
     * @param ArtistRepository $artistRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(
        AlbumRepository $albumRepository,
        ArtistRepository $artistRepository,
        EntityManagerInterface $em
    ) {
        $this->albumRepository = $albumRepository;
        $this->artistRepository = $artistRepository;
        $this->em = $em;
    }

    /**
     * @param Argument $args
     *
     * @return Album
     */
    public function update(Argument $args): Album
    {
        $album = $this->albumRepository->find($args['id']);
        $album->update(
            $args['input']['name'],
            $args['input']['year'],
            $this->artistRepository->find($args['input']['artist'])
        );

        $this->em->flush();

        return $album;
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['update' => 'update_album'];
    }
}
