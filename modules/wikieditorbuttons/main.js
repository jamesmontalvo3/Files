(function(){

	var customizeToolbar = function() {
	
		$( '.wikiEditor-ui-text textarea' ).wikiEditor( 'removeFromToolbar', {
			'section': 'main',
			'group': 'insert',
			'tool': 'file'
		});
		
		// add "file link" button
		$('.wikiEditor-ui-text textarea').wikiEditor('addToToolbar', {
			section: 'main',
			group: 'insert',
			tools: {
				'filelink': {
					'label': 'File link',
					'type': 'button',
					'icon': mw.config.get( 'wgExtensionAssetsPath' ) + '/Files/modules/wikieditorbuttons/file-icon.png',
					'action': {
						'type': 'encapsulate',
						'options': {
							'pre': "{{#file: ",
							'peri': "Example.pdf | Alternate display text",
							'post': " }}",
							'ownline': false
						}
					}
				}
			}
		});

		// add "image list" button
		$('.wikiEditor-ui-text textarea').wikiEditor('addToToolbar', {
			section: 'main',
			group: 'insert',
			tools: {
				'imagelist': {
					'label': 'Image list',
					'type': 'button',
					'icon': 'insert-gallery.png',
					'offset': [2, -1510],
					'action': {
						'type': 'encapsulate',
						'options': {
							'pre': "{{Image list | \n",
							'peri': "File:Example.jpg## Caption for local wiki image\njsc2000e31343##    Caption for IO image",
							'post': "\n}}",
							'ownline': true
						}
					}
				}
			}
		});
	};
	
	 
	/* Check if view is in edit mode and that the required modules are available. Then, customize the toolbar . . . */
	if ( $.inArray( mw.config.get( 'wgAction' ), ['edit', 'submit', 'formedit'] ) !== -1 ) {
		mw.loader.using( 'user.options', function () {
			if ( mw.user.options.get('usebetatoolbar') ) {
				mw.loader.using( 'ext.wikiEditor.toolbar', function () {
					$(document).ready(function(){
						// FIXME: cannot find documentation on WikiEditor
						// explaining how to reorder buttons in toolbar
						setTimeout( customizeToolbar, 500 );
					});
				} );
			}
		} );
	}

})();