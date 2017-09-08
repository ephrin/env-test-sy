<?php

use Symfony\Component\DependencyInjection\ContainerInterface;

/** @var ContainerInterface $container */

$container->setParameter('pdo_mysql_options', [
    //PDO::MYSQL_ATTR_SSL_CA => '%mysql_ca_file%',
    PDO::MYSQL_ATTR_SSL_KEY => '%mysql_key_file%',
    PDO::MYSQL_ATTR_SSL_CERT => '%mysql_cert_file%',
]);

