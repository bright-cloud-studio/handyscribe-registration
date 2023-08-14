<?php

/**
 * Bright Cloud Studio's Handyscribe Registration
 *
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/handyscribe-registration
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

 /* Extend the tl_user palettes */
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $k => $v) {
    $GLOBALS['TL_DCA']['tl_user']['palettes'][$k] = str_replace('email;', 'email;{handyscribe_legend},ein;', $v);
}

/* Add fields to tl_user */
$GLOBALS['TL_DCA']['tl_user']['fields']['ein'] = array
(
  'label'			=> &$GLOBALS['TL_LANG']['tl_user']['ein'],
  'inputType'		=> 'text',
  'eval'                	=> [
    'mandatory'=>false,
    'tl_class'=>'w50'
  ],
  'sql'                   => "varchar(255) NOT NULL default ''"
);
