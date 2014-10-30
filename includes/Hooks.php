<?php
/**
 * <INSERT DESCRIPTION>.
 * 
 * Documentation: http://???
 * Support:       http://???
 * Source code:   http://???
 *
 * @file FilesParserFunctions.php
 * @addtogroup Extensions
 * @author James Montalvo
 * @copyright © 2014 by James Montalvo
 * @licence GNU GPL v3+
 */

namespace ExtensionFiles;

class Hooks {

	static function setupParserFunctions ( &$parser ) {
		
		// set the {{#file: ... }} parser function
		$parser->setFunctionHook(
			'file', // the name of parser function 
			array(
				'ExtensionFiles\FileParserFunction',
				'renderFileLink'
			),
			SFH_OBJECT_ARGS
		);

		return true;
		
	}
	


	/**
	* Handler for BeforePageDisplay hook.
	* @see http://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
	* @param $out OutputPage object
	* @param $skin Skin being used.
	* @return bool true in all cases
	*/
	static function onBeforePageDisplay( $out, $skin ) {
		$out->addModules( array( 'ext.files.wikieditorbuttons' ) );
	}

}