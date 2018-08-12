<?php

namespace PushoverCli;

use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends SymfonyApplication
{

    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        return parent::run($input, $output);
    }

}