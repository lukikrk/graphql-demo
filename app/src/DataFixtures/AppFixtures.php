<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    private array $data = [
        [
            'name' => 'AC/DC',
            'albums' => [
                [
                    'name' => 'Back in Black',
                    'year' => 1980,
                    'tracks' => [
                        [
                            'name' => "Hells Bells",
                            'position' => 1,
                            'length' => 310
                        ],
                        [
                            'name' => "Shoot to Thrill",
                            'position' => 2,
                            'length' => 317
                        ],
                        [
                            'name' => "What Do You Do for Money Honey",
                            'position' => 3,
                            'length' => 213
                        ],
                        [
                            'name' => "Given the Dog a Bone",
                            'position' => 4,
                            'length' => 210
                        ],
                        [
                            'name' => "Let Me Put My Love into You",
                            'position' => 5,
                            'length' => 256
                        ],
                        [
                            'name' => "Back in Black",
                            'position' => 6,
                            'length' => 254
                        ],
                        [
                            'name' => "You Shook Me All Night Long",
                            'position' => 7,
                            'length' => 210
                        ],
                        [
                            'name' => "Have a Drink on Me",
                            'position' => 8,
                            'length' => 237
                        ],
                        [
                            'name' => "Shake a Leg",
                            'position' => 9,
                            'length' => 246
                        ],
                        [
                            'name' => "Rock and Roll Ain't Noise Pollution",
                            'position' => 10,
                            'length' => 255
                        ],
                    ]
                ],
                [
                    'name' => "The razor's edge",
                    'year' => 1991,
                    'tracks' => [
                        [
                            'name' => 'Thunderstruck',
                            'position' => 1,
                            'length' => 292
                        ],
                        [
                            'name' => "Fire Your Guns",
                            'position' => 2,
                            'length' => 173
                        ],
                        [
                            'name' => "Moneytalks",
                            'position' => 3,
                            'length' => 228
                        ],
                        [
                            'name' => "The Razors Edge",
                            'position' => 4,
                            'length' => 262
                        ],
                        [
                            'name' => "Mistress for Christmas",
                            'position' => 5,
                            'length' => 239
                        ],
                        [
                            'name' => "Rock Your Heart Out",
                            'position' => 6,
                            'length' => 246
                        ],
                        [
                            'name' => "Are You Ready",
                            'position' => 7,
                            'length' => 250
                        ],
                        [
                            'name' => "Got You by the Balls",
                            'position' => 8,
                            'length' => 270
                        ],
                        [
                            'name' => "Shot of Love",
                            'position' => 9,
                            'length' => 236
                        ],
                        [
                            'name' => "Let's Make It",
                            'position' => 10,
                            'length' => 212
                        ],
                        [
                            'name' => "Goodbye and Good Riddance to Bad Luck",
                            'position' => 11,
                            'length' => 193
                        ],
                        [
                            'name' => "If You Dare",
                            'position' => 12,
                            'length' => 188
                        ],
                    ]
                ]
            ],
        ],
        [
            'name' => 'Metallica',
            'albums' => [
                [
                    'name' => 'Black Album',
                    'year' => 1980,
                    'tracks' => [
                        [
                            'name' => 'Enter Sandman',
                            'position' => 1,
                            'length' => 334
                        ],
                        [
                            'name' => "Sad but True",
                            'position' => 2,
                            'length' => 324
                        ],
                        [
                            'name' => "Holier Than Thou",
                            'position' => 3,
                            'length' => 228
                        ],
                        [
                            'name' => "The Unforgiven",
                            'position' => 4,
                            'length' => 386
                        ],
                        [
                            'name' => "Wherever I May Roam",
                            'position' => 5,
                            'length' => 406
                        ],
                        [
                            'name' => "Don't Tread on Me",
                            'position' => 6,
                            'length' => 241
                        ],
                        [
                            'name' => "Through the Never",
                            'position' => 7,
                            'length' => 243
                        ],
                        [
                            'name' => "Nothing Else Matters",
                            'position' => 8,
                            'length' => 390
                        ],
                        [
                            'name' => "Of Wolf and Man",
                            'position' => 9,
                            'length' => 257
                        ],
                        [
                            'name' => "The God That Failed",
                            'position' => 10,
                            'length' => 309
                        ],
                        [
                            'name' => "My Friend of Misery",
                            'position' => 11,
                            'length' => 408
                        ],
                        [
                            'name' => "The Struggle Within",
                            'position' => 12,
                            'length' => 236
                        ],
                    ]
                ]
            ],
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $artist) {
            $newArtist = new Artist(Uuid::uuid4(), $artist['name']);

            foreach ($artist['albums'] as $album) {
                $newAlbum = new Album(Uuid::uuid4(), $album['name'], $album['year'], $newArtist);

                foreach ($album['tracks'] as $track) {
                    $track = new Track(Uuid::uuid4(), $track['name'], $track['position'], $track['length'], $newAlbum);

                    $manager->persist($track);
                }
            }
        }

        $manager->flush();
    }
}
