<?php
namespace Command;

use Command\CommandWrapper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class ListGetCommand extends CommandWrapper
{
    protected function configure()
    {
        $this
            ->setName('list:get')
            ->setDescription('Get MyKindleList from kindle.amazon.co.jp');
    }
    protected function execute(Inputinterface $input, OutputInterface $output)
    {
        $model = $this->container['model'];
        foreach($model->getListAll() as $kindle) {
            $output->writeln("<fg=green>{$kindle->title}</fg=green> - <fg=green>{$kindle->author}</fg=green>");
        }
    }
}
