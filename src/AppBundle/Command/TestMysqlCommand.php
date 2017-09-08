<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TestMysqlCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('test:mysql')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getContainer()->get('doctrine')->getManager('mysql');

        $connection = $em->getConnection();

        $table = uniqid('test_', true);

        $val = uniqid('value_', true);

        $int = random_int(0, time());

        $connection->exec("create table `$table` (`id` INT, `text` VARCHAR(255))");
        $connection->exec("insert into `$table` (`id`, `text`) VALUES ($int, '$val')");
        $res = $connection->fetchArray("select * from `$table` WHERE `id` = ?",  [$int]);

        var_dump($res);

        var_dump($connection->fetchArray("SHOW STATUS LIKE 'Ssl_cipher';"));

        return;
    }

}
