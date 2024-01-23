<?php

declare(strict_types=1);

namespace Donguri;

class Data
{
    public function __construct()
    {
    }

    public function read(string $file)
    {
        return json_decode(file_get_contents($file), true);
    }

    public function write_json(string $jsonFile, $data)
    {
        file_put_contents($jsonFile, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), LOCK_EX);
    }
}
