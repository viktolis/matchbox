<?php

namespace App\Command;

use App\Enum\ConverterFormatEnum;
use App\Enum\ConverterTypeEnum;
use App\Model\ConverterArgument;
use App\Services\Collector\ConverterCollector;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:converter',
    description: 'Command that converts data in different formats',
)]
class ConverterCommand extends Command
{
    protected ConverterCollector $converterCollector;
    protected string $defaultPath;

    public function setConverterCollector(ConverterCollector $converterCollector): self
    {
        $this->converterCollector = $converterCollector;

        return $this;
    }

    public function setDefaultPath(string $defaultPath): self
    {
        $this->defaultPath = $defaultPath;

        return $this;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('type', InputArgument::REQUIRED, 'Type of convert operation')
            ->addArgument('format', InputArgument::REQUIRED, 'Format used for convert operation')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $type = ConverterTypeEnum::tryFrom($input->getArgument('type'));
        $format = ConverterFormatEnum::tryFrom($input->getArgument('format'));
        $path = $this->defaultPath;

        if(!$type){
            $io->error(sprintf('Converter with type %s not found', $input->getArgument('type')));

            return Command::FAILURE;
        }

        if(!$format){
            $io->error(sprintf('Converter for %s format not found', $input->getArgument('format')));

            return Command::FAILURE;
        }

        if($type === ConverterTypeEnum::Import){
            $finder = new Finder();
            $files = $finder->in($this->defaultPath)->name(sprintf('*.%s', $format->value));

            if(!$files->hasResults()){
                $io->error(sprintf('Files of %s format do not exist in default folder, please export first.', $input->getArgument('format')));

                return Command::FAILURE;
            }

            $paths = [];

            foreach ($files->files() as $file) {
                $paths[] = $file->getPathname();
            }

            $path = $io->choice('What file would you like to import ?', $paths);
        }

        $this
            ->converterCollector
            ->getConverter($type)
            ->convert(
                new ConverterArgument(
                    $path,
                    $format
                )
            );

        $io->success('Done');

        return Command::SUCCESS;
    }
}
