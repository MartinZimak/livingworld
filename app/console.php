#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$container->setParameter('tmp.dir', __DIR__.'/../tmp');

$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
$loader->load('services.yml');

$application = new Application();
$application->add($container->get('import.command'));
$application->add($container->get('generate.world.command'));

$application->run();
