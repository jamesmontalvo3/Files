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

class FilesParserFunctions
{

	static function setup ( &$parser ) {
		
		$parser->setFunctionHook(
			'File', // the name of parser function 
			array(
				'FilesParserFunctions',
				'renderFileLink'
			),
			SFH_OBJECT_ARGS
		);

		return true;
		
	}
	

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
			return self::formatHttpFile( $file, $alt );
		}
		
		// if starts with file://
		else if ( preg_match( "/^file:\/\//i", $file ) ) {
			return self::formatFileSystemFile( $file, $alt );
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
			$altText = preg_replace( "/^http[s]*:\/\//i", "", $file );
			if ( strlen( $altText ) > $maxLength ) {
				$altText = substr( $altText, 0, $maxLength );
			}
		}
		
		return "[$file $altText]";
	}
	
	static function formatFileSystemFile ( $file, $altText='' ) {
		return "<code><nowiki>$file</nowiki></code>";
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
		
		$mediaLink = '[[Media:' . $fileNameOnly;

		if ( $altText !== '' ) {
			$mediaLink .= '|' . $altText;
		}
		
		$mediaLink .= ']]';
		
		$fileInfoLink = ' <sup><nowiki>[</nowiki>[[:$fileWithPrefix|file info]]<nowiki>]</nowiki>';

		return $mediaLink . $fileInfoLink;
	
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