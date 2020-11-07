<?php


namespace App\Application\Query;


interface Query
{
    public function execute(array $args = []);
}