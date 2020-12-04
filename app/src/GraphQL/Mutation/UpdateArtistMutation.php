<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class UpdateArtistMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var ArtistRepository
     */
    private ArtistRepository $artistRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param ArtistRepository $artistRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ArtistRepository $artistRepository, EntityManagerInterface $entityManager)
    {
        $this->artistRepository = $artistRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @param Argument $args
     *
     * @return Artist
     */
    public function update(Argument $args): Artist
    {
        $artist = $this->artistRepository->find($args['id']);
        $artist->update($args['input']['name']);

        $this->entityManager->flush();

        return $artist;
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return [
            'update' => 'update_artist',
        ];
    }
}
