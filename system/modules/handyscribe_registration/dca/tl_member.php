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

use Contao\Backend;
use Contao\BackendUser;
use Contao\Config;
use Contao\CoreBundle\EventListener\Widget\HttpUrlListener;
use Contao\Database;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\FrontendUser;
use Contao\Image;
use Contao\MemberGroupModel;
use Contao\MemberModel;
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

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
    'filter'                  => true,
    'sorting'                 => true,
    'inputType'               => 'select',
    'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'chosen'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'address', 'tl_class'=>'w50'),
    'options_callback'        => static fn () => System::getContainer()->get('contao.intl.countries')->getCountries(),
    'sql'                     => "varchar(2) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['phone'] = array
(
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);
