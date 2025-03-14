<?php

namespace Gerenuk\Spotify\Commands;

use Illuminate\Console\Command;

class SpotifyCommand extends Command
{
    public $signature = 'spotify-for-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
