<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation;

use App\Entity\Artist;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Ramsey\Uuid\Uuid;

class CreateArtistMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @param Argument $args
     * @return Artist
     *
     * @throws \Exception
     */
    public function create(Argument $args): Artist
    {
        $artist = new Artist(Uuid::uuid4(), $args['input']['name']);

        $this->em->persist($artist);
        $this->em->flush();

        return $artist;
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return [
            'create' => 'create_artist',
        ];
    }
}
