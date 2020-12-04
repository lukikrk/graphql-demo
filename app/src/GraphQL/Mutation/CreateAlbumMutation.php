<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Entity\Album;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Ramsey\Uuid\Uuid;

class CreateAlbumMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var ArtistRepository
     */
    private ArtistRepository $artistRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param ArtistRepository $artistRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(ArtistRepository $artistRepository, EntityManagerInterface $em)
    {
        $this->artistRepository = $artistRepository;
        $this->em = $em;
    }

    public function create(Argument $args): Album
    {
        $album = new Album(
            Uuid::uuid4(),
            $args['input']['name'],
            $args['input']['year'],
            $this->artistRepository->find($args['input']['artist'])
        );

        $this->em->persist($album);
        $this->em->flush();

        return $album;
    }


    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['create' => 'create_album'];
    }
}
