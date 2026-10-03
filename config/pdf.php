<?php

return [
    'mode'                     => '',
    'format'                   => 'A4',
	'default_font_size'        => '13',
	'default_font'             => 'hindsiliguri',
	'margin_left'              => 5,
	'margin_right'             => 5,
	'margin_top'               => 5,
	'margin_bottom'            => 5,
	'margin_header'            => 0,
	'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => config('global.webName'),
    'subject'                  => '',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => true,
    'show_watermark_image'     => true,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => public_path('logo_watermark.png'),
    'watermark_image_alpha'    => 0.05,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'custom_font_dir'          => '',
    'custom_font_data'         => [],
    'auto_language_detection'  => false,
    'temp_dir'                 => storage_path('app'),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,

    'custom_font_dir'  => base_path('resources/fonts/custom/'),
    'custom_font_data' => [
        "hindsiliguri" => [
			'R' => "HindSiliguri-Regular.ttf",
			'B' => "HindSiliguri-Bold.ttf",
			'I' => "HindSiliguri-Regular.ttf",
			'BI' => "HindSiliguri-Bold.ttf",
			'useOTL' => 0xFF,
		],
        "nikosh" => [
			'R' => "NikoshBAN.ttf",
			'useOTL' => 0xFF,
		],
		"alinur" => [
			'R' => "Li Alinur Anupom Unicode.ttf",
			'useOTL' => 0xFF,
		],
		"alinur2" => [
			'R' => "Li Alinur Boisakh Unicode.ttf",
			'useOTL' => 0xFF,
		],
		"kalpurush" => [
			'R' => "kalpurush.ttf",
			'useOTL' => 0xFF,
		],
		"siyamrupali" => [
			'R' => "Siyamrupali.ttf",
			'useOTL' => 0xFF,
		],
		"sutoni" => [
			'R' => "SutonnyOMJ.ttf",
			'I' => "SutonnyMJ-Italic.ttf",
			'B' => "SutonnyMJ-Bold.ttf",
			'BI' => "SutonnyMJ-BoldItalic.ttf",
			'useOTL' => 0xFF,
		],
		"cholontika" => [
			'R' => "Cholontika.ttf",
			'I' => "Cholontika_Italic.ttf",
			'useOTL' => 0xFF,
		],
		"shiraji" => [
			'R' => "Li Sirajee Humayra Unicode.ttf",
			'I' => "Li Sirajee Humayra Unicode Italic.ttf",
			'useOTL' => 0xFF,
		],

        "alinur_tatshom" => [
			'R' => "Li Alinur Tatsama Unicode.ttf",
			'I' => "Li Alinur Tatsama Unicode Italic.ttf",
			'useOTL' => 0xFF,
		],

		"english2" => [
			'R' => "Playball-Regular.ttf",
			'useOTL' => 0xFF,
		],
		"english" => [
			'R' => "DancingScript-Regular.ttf",
			'B' => "DancingScript-Bold.ttf",
			'useOTL' => 0xFF,
		],

		"english_transcript_value" => [
			'R' => "junicode.bold.ttf",
			'useOTL' => 0xFF,
		],
		"english_transcript_title" => [
			'R' => "antipasto.bold.ttf",
			'B' => "antipasto.demibold.ttf",
		],

    ]
];
