<?php
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class CommandWrapper extends Command
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
        parent::__construct(null);
    }
}
