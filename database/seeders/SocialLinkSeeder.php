<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'platform' => 'GitHub',
                'url' => 'https://github.com/KalavalapalliMohan',
            ],
            [
                'platform' => 'LinkedIn',
                'url' => 'https://linkedin.com/in/mohan',
            ],
            [
                'platform' => 'Twitter',
                'url' => 'https://twitter.com/mohan',
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://youtube.com/@mohan',
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                ['url' => $link['url']]
            );
        }
    }
}