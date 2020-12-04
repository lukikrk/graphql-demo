<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Entity\Track;
use App\Repository\TrackRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class TrackResolver implements ResolverInterface, AliasedInterface
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

    /**
     * @param Argument $args
     *
     * @return Track
     */
    public function resolve(Argument $args): Track
    {
        return $this->trackRepository->find($args['id']);
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return  ['resolve' => 'Track'];
    }
}
