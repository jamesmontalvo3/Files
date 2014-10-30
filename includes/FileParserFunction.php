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

class FileParserFunction {

	static function renderFileLink ( &$parser, $frame, $args ) {

		// self::addJSandCSS(); // adds the javascript and CSS files 
		
		// first argument
		$file = trim( $frame->expand($args[0]) );

		// check for second argument
		if ( count($args) > 1 )
			$altText = trim( $frame->expand($args[1]) );
		else
			$altText = "";
		
				
		// if starts with http(s)://
		if ( preg_match( "/^http[s]*:\/\//i", $file ) ) {
			return self::formatHttpFile( $file, $altText );
		}
		
		// if starts with file://
		else if ( preg_match( "/^file:\/\//i", $file ) ) {
			return self::formatFileSystemFile( $file, $altText );
		}
		
		// if starts with an interwiki prefix (not yet supported)
		// else if ( false ) {
		// }
		
		// else assume wiki file
		else {
			return self::formatWikiFile( $file, $altText );
		}
		
	}
	
	static function formatHttpFile ( $file, $altText='' ) {
		if ( $altText == '' ) {
			$maxLength = 50;
			$altText = preg_replace( "/^http[s]*:\/\//i", "", $file );
			if ( strlen( $altText ) > $maxLength ) {
				$altText = substr( $altText, 0, $maxLength-3 ) . '...';
			}
		}
		
		return "[$file $altText]";
	}
	
	static function formatFileSystemFile ( $file, $altText='' ) {
		return "<code>$file</code>";
	}

	static function formatWikiFile ( $file, $altText='' ) {
				
		// if starts with "File:" strip it for file name
		if ( preg_match( "/^File:/i", $file ) ) {
			$fileNameOnly = substr( $file, 5 );
			$fileWithPrefix = $file;
		}
		else {
			$fileNameOnly = $file;
			$fileWithPrefix = 'File:' . $file;
		}

		if ( $altText == '' ) {
			$altText = $fileNameOnly;
		}		

		if ( \Title::makeTitle( NS_FILE, $fileNameOnly )->exists() ) {
			
			return "[[Media:$fileNameOnly|$altText]] <sup>&#91;[[:$fileWithPrefix|file info]]&#93;</sup>";
		
		}
		else {
			return "[[$fileWithPrefix]]";
		}
		
	}
	
	// static function addJSandCSS () {
	
		// global $wgOut, $wgExtensionAssetsPath;
		
		// $wgOut->addScriptFile( "$wgExtensionAssetsPath/BlankParserFunction/BlankParserFunction.js" );

		// $wgOut->addLink( array(
			// 'rel' => 'stylesheet',
			// 'type' => 'text/css',
			// 'media' => "screen",
			// 'href' => "$wgExtensionAssetsPath/BlankParserFunction/BlankParserFunction.css"
		// ) );
		
		// return true;

	// }
	
}