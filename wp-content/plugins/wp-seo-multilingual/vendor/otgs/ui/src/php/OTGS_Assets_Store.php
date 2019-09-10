<?php

/**
 * @author OnTheGo Systems
 */
class OTGS_Assets_Store {

	/** @var array */
	private $assets_files_store = array();
	/** @var array */
	private $assets = array();

	/**
	 * @param string $type
	 * @param null   $handle
	 *
	 * @return array|mixed
	 */
	public function get( $type, $handle = null ) {
		$result = array();

		$this->parse_assets();
		if ( array_key_exists( $type, $this->assets ) ) {
			$result = $this->assets[ $type ];
		}

		if ( $handle ) {
			if ( array_key_exists( $handle, $this->assets[ $type ] ) ) {
				$result = $this->assets[ $type ][ $handle ];
			} else {
				$result = array();
			}
		}

		return $result;
	}

	/**
	 * @param string $path
	 */
	public function add_assets_location( $path ) {
		if ( ! in_array( $path, $this->assets, true ) ) {
			$this->assets_files_store[] = $path;
		}
	}

	/**
	 * @uses $this->assets
	 */
	private function parse_assets() {
		if ( ! $this->assets ) {
			foreach ( $this->assets_files_store as $assets_file ) {
				$this->add_asset( $assets_file );
			}
		}
	}

	/**
	 * @param string $assets_file
	 */
	private function add_asset( $assets_file ) {
		$assets = $this->get_assets_file( $assets_file );
		if ( ! $assets || ! is_string( $assets ) ) {
			return;
		}

		$assets_data = json_decode( $assets, true );

		if ( $assets_data && array_key_exists( 'entrypoints', $assets_data ) ) {
			foreach ( $assets_data['entrypoints'] as $handle => $resources ) {
				$this->add_resources( $handle, $resources );
			}
		}
	}

	/**
	 * @param string $assets_file
	 *
	 * @return string|null|bool
	 */
	private function get_assets_file( $assets_file ) {
		/** @var \WP_Filesystem_Base $wp_filesystem */
		global $wp_filesystem;

		if ( $this->maybe_init_file_system( $wp_filesystem ) ) {
			return $wp_filesystem->get_contents( $assets_file );
		}

		return null;
	}

	/**
	 * @param \WP_Filesystem_Base $wp_filesystem
	 *
	 * @see \WP_Filesystem
	 *
	 * @return bool|null
	 */
	private function maybe_init_file_system( $wp_filesystem = null ) {
		/** @var \WP_Filesystem_Base $wp_filesystem */
		global $wp_filesystem;

		if ( ! $wp_filesystem ) {
			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
			}

			return WP_Filesystem();
		}

		return true;
	}

	/**
	 * @param string $handle
	 * @param array  $resources
	 */
	private function add_resources( $handle, $resources ) {
		foreach ( $resources as $type => $path ) {
			if ( ! array_key_exists( $type, $this->assets ) ) {
				$this->assets[ $type ] = array();
			}
			$this->assets[ $type ][ $handle ] = $path;
		}
	}
}