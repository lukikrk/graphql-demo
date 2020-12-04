<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class AlbumResolver implements ResolverInterface, AliasedInterface
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
     * @return Album
     */
    public function resolve(Argument $args): Album
    {
        return $this->albumRepository->find($args['id']);
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'Album'];
    }
}
