<?php

namespace App;

/**
 * Class Markdown
 *
 * @package \App\Markdown
 */
class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     *
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text)
    {
        $html = $this->parser->makeHtml($text);

        return $html;
    }


}