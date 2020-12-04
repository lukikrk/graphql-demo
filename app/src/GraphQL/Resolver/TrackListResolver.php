<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Repository\TrackRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class TrackListResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var TrackRepository
     */
    private TrackRepository $trackRepository;

    /**
     * @param TrackRepository $trackRepository
     */
    public function __construct(TrackRepository $trackRepository)
    {
        $this->trackRepository = $trackRepository;
    }

    public function resolve(Argument $args): array
    {
        $tracks = $this->trackRepository->findBy(
            $args['album'] ? ['album' => $args['album']] : [],
            null,
            $args['limit']
        );

        return ['tracks' => $tracks];
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return ['resolve' => 'TrackList'];
    }
}
