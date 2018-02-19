<?php declare(strict_types=1);

$header = <<<EOF
This file is part of the yii2lib/example.
(c) frontbear <frontbear@outlook.com>
This source file is subject to the BSD-3-Clause license that is bundled.
EOF;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony'             => true,
        'header_comment'       => [
            'header'      => $header,
            'commentType' => 'comment',
        ],
        'array_syntax'         => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'ordered_imports'      => true,
        'no_useless_else'      => true,
        'no_useless_return'    => true,
        'php_unit_construct'   => true,
        'php_unit_strict'      => true,
        'phpdoc_separation'    => false,
        'concat_space'         => ['spacing' => 'one'],
        'phpdoc_align'         => ['tags' => []],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('vendor')
            ->in(__DIR__)
    );
