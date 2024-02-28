<?php

namespace Jkbroot\Thawani\Console\Commands;

use Illuminate\Console\Command;


class ThawaniCommand extends Command {
    protected $signature = 'make:thawani';

    protected $description = 'thawani';
    protected $createdMethods = [];

    public function handle() {
        $this->info('Starting thawani...');
    }

}
