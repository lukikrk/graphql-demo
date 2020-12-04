<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ArtistResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var ArtistRepository
     */
    private ArtistRepository $artistRepository;

    /**
     * @param ArtistRepository $artistRepository
     */
    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * @param Argument $args
     *
     * @return Artist
     */
    public function resolve(Argument $args): Artist
    {
        return $this->artistRepository->find($args['id']);
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'Artist'];
    }
}
