<?php

namespace App;


use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CsvToJsonCommand extends Command{
    public static function getDefaultName(): ?string
    {
        return 'csv-to-json';
    }
    protected function configure(): void
    {
        $this
            ->setDefinition(
                new InputDefinition([
                    new InputOption('input', '', InputOption::VALUE_REQUIRED, 'input file name'),
                    new InputOption('output', '', InputOption::VALUE_REQUIRED, 'output file name'),
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFileName = $input->getOption('input');
        $outputFileName = $input->getOption('output');

        if(!file_exists($inputFileName)){
            $output->writeln('file not found');
            return Command::FAILURE;
        }

        $items = array_map('str_getcsv', file($inputFileName));
        $header = array_shift($items);
        $jsonContent = [];
        foreach ($items as $item) {
            $jsonContent[] = array_combine($header, $item);
        };

       file_put_contents($outputFileName, json_encode($jsonContent, JSON_PRETTY_PRINT));

       $output->writeln('<info>success file created</info>');

        // var_dump($jsonContent);

        return Command::SUCCESS;
    }
}