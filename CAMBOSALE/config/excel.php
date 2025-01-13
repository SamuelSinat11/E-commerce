<?php 

return [
    'exports' => [
        'chunk_size'             => 1000,
        'pre_calculate_formulas' => false,
        'strict_null_comparison' => false,
        'csv'                    => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => "\n",
            'use_bom'                => false,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
            'output_encoding'        => '',
        ],
    ],
    'imports'            => [
        'read_only'        => true,
        'heading_row'      => [
            'formatter' => 'slug',
        ],
        'csv'              => [
            'delimiter'        => ',',
            'enclosure'        => '"',
            'escape_character' => '\\',
            'contiguous'       => false,
            'input_encoding'   => 'UTF-8',
        ],
    ],
    'extension_detector' => [
        'xlsx' => 'Xlsx',
        'xlsm' => 'Xlsx',
        'xltx' => 'Xlsx',
        'xltm' => 'Xlsx',
        'xls'  => 'Xls',
        'xlt'  => 'Xls',
        'ods'  => 'Ods',
        'ots'  => 'Ods',
        'slk'  => 'Slk',
        'xml'  => 'Xml',
        'gnumeric' => 'Gnumeric',
        'htm'      => 'Html',
        'html'     => 'Html',
        'csv'      => 'Csv',
        'tsv'      => 'Csv',
    ],
    'value_binder' => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],
];
