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
foreach ($GLOBALS['TL_DCA']['tl_member']['palettes'] as $k => $v) {
    $GLOBALS['TL_DCA']['tl_member']['palettes'][$k] = str_replace('groups;', 'groups;{handyscribe_legend},ein;', $v);
}

/* Add fields to tl_user */
$GLOBALS['TL_DCA']['tl_member']['fields']['ein'] = array
(
    'search'                  => true,
    'sorting'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'personal', 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['country'] = array
(
    'eval'                    => array('mandatory'=>true),
);

$GLOBALS['TL_DCA']['tl_member']['fields']['phone'] = array
(
    'eval'                    => array('mandatory'=>true),
);
