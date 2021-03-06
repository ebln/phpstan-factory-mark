<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('tests')
    ->in(__DIR__);

$rules = [
    '@PSR2'                      => true,
    '@Symfony'                   => true,
    '@PhpCsFixer'                => true,
    '@PhpCsFixer:risky'          => true,
    '@PHPUnit75Migration:risky'  => true,
    '@PHP71Migration:risky'      => true,
    'php_unit_dedicate_assert'   => ['target' => '5.6'],
    'array_syntax'               => ['syntax' => 'short'],
    'no_superfluous_phpdoc_tags' => true,
    'native_function_invocation' => false,
    'concat_space'               => ['spacing' => 'one'],
    'phpdoc_types_order'         => ['null_adjustment' => 'always_first', 'sort_algorithm' => 'alpha'],
    'single_line_comment_style'  => [
        'comment_types' => ['hash'],
    ],
    'phpdoc_summary'             => false,
    'cast_spaces'                => ['space' => 'none'],
    'binary_operator_spaces'     => ['default' => null, 'operators' => ['=' => 'align_single_space_minimal', '=>' => 'align_single_space_minimal']],
    'no_unused_imports'          => true,
    'ordered_imports'            => ['sort_algorithm' => 'alpha', 'imports_order' => ['const', 'class', 'function']],
];
if (version_compare(PHP_VERSION, '7.3.0', '>=')) {
    $rules['@PHP73Migration'] = true;
}

$config = new PhpCsFixer\Config();
$config->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder);

return $config;
