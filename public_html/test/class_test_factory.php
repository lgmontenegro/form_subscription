<?php
namespace olx\test;

Class Factory
{
    public static function create($name, array $args)
    {
        return new Make($name, $args);
    }
}