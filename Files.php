<?php
/** 
 * Creates a parser function to create better links to files, which links
 * directly to the file itself with an additional superscript link to the file
 * info page.
 * 
 * Documentation: http://???
 * Support:       http://???
 * Source code:   http://???
 *
 * @file Files.php
 * @addtogroup Extensions
 * @author James Montalvo
 * @copyright © 2014 by James Montalvo
 * @licence GNU GPL v3+
 */

# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {
	die( "FileLink extension" );
}

$GLOBALS['wgExtensionCredits']['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'Files',
	'url'            => 'http://github.com/enterprisemediawiki/Files',
	'author'         => 'James Montalvo',
	'descriptionmsg' => 'extension-files-desc',
	'version'        => '0.1.0'
);

$dir = dirname( __FILE__ ) . '/';

$GLOBALS['wgMessagesDirs']['Files'] = __DIR__ . '/i18n';

$GLOBALS['wgAutoloadClasses']['FilesParserFunctions'] = $dir . 'FilesParserFunctions.php';

$GLOBALS['wgHooks']['ParserFirstCallInit'][] = 'FilesParserFunctions::setup';