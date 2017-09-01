<?php

use Pagekit\Application;

return [
	'name' => 'spqr/selectionshare',
	'type' => 'extension',
	'main' => function( Application $app ) {
	
	},
	
	'autoload' => [
		'Spqr\\selectionshare\\' => 'src'
	],
	
	'nodes' => [],
	
	'routes' => [],
	
	'widgets' => [],
	
	'menu' => [],
	
	'permissions' => [
		'selectionshare: manage settings' => [
			'title' => 'Manage settings'
		]
	],
	
	'settings' => 'selectionshare-settings',
	
	'resources' => [
		'spqr/selectionshare:' => ''
	],
	
	'config' => [
		'nodes' => []
	],
	
	'events' => [
		'boot'         => function( $event, $app ) {
		},
		'site'         => function( $event, $app ) {
			$app->on(
				'view.content',
				function( $event, $scripts ) use ( $app ) {
					if ( ( !$this->config[ 'nodes' ] || in_array( $app[ 'node' ]->id, $this->config[ 'nodes' ] ) ) ) {
						$config = $this->config;
						$app[ 'styles' ]->add(
							'selection-sharer',
							'spqr/selectionshare:app/assets/selection-sharer/dist/selection-sharer.css'
						);
						$app[ 'scripts' ]->add(
							'selection-sharer',
							'spqr/selectionshare:app/assets/selection-sharer/dist/selection-sharer.js',
							[ 'jquery' ]
						);
						$app[ 'scripts' ]->add(
							'selectionshare',
							'spqr/selectionshare:app/assets/selectionshare/selectionshare.js',
							[],
							[ 'defer' => true ]
						);
					}
				}
			);
		},
		'view.scripts' => function( $event, $scripts ) use ( $app ) {
			$scripts->register(
				'selectionshare-settings',
				'spqr/selectionshare:app/bundle/selectionshare-settings.js',
				[ '~extensions' ]
			);
		}
	]
];