<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Repository\ArtistRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ArtistListResolver implements ResolverInterface, AliasedInterface
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
     * @return array
     */
    public function resolve(Argument $args): array
    {
        $artists = $this->artistRepository->findBy([], null, $args['limit']);

        return ['artists' => $artists];
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'ArtistList'
        ];
    }
}
