<?php

/**
 * Create file from stub
 *
 * @param     string     $from            stub file path
 * @param     string     $to              target file path
 * @param     array      $replacements    replacements array
 * @param     integer    $chmod           chmod used if directory should be created
 *
 * @return    string                      target file path
 */
function stub(string $from, string $to, array $replacements = [], int $chmod = 0777): string
{
    //
    // create directory if not present
    //
    $path = dirname($to);

    if(!file_exists($path))
        mkdir($path, $chmod, TRUE);

    //
    // prepare placeholders
    //
    $placeholders = array_map(function($item){
        return '{{'.$item.'}}';
    }, array_keys($replacements));

    //
    // replace contents
    //
    $contents = file_get_contents($from);
    $contents = str_replace($placeholders, array_values($replacements), $contents);

    // dd($placeholders, array_values($replacements));

    //
    // and store
    //
    file_put_contents($to, $contents);

    return $to;
}
