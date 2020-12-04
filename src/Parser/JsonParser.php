<?php

namespace Imdb\Parser;

class JsonParser implements ParserInterface
{
    public function parse($string)
    {
        return json_decode($string);
    }

}
