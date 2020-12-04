<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Repository\AlbumRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class AlbumListResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var AlbumRepository
     */
    private AlbumRepository $albumRepository;

    /**
     * @param AlbumRepository $albumRepository
     */
    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    /**
     * @param Argument $args
     *
     * @return array
     */
    public function resolve(Argument $args): array
    {
        $albums = $this->albumRepository->findBy(
            $args['artist'] ? ['artist' => $args['artist']] : [],
            null,
            $args['limit']
        );

        return ['albums' => $albums];
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'AlbumList'];
    }
}
