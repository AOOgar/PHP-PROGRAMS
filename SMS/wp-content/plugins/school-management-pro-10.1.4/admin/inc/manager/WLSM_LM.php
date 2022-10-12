<?php
defined( 'ABSPATH' ) or die();

final class WLSM_LM {
    private $api_url = 'https://api.envato.com/v3/market/author/sale';
    private $item_id = 24678776;
    private $key = null;
    public $error_message = null;
    private static $instance = null;

    private function __construct() {
        $this->code = '';
    }

    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function validate( $code ) {
        $this->code = $code;
        return $this->is_valid();
    }

    public function is_valid() {
        try {
            if ( get_option( 'wlsm-code' ) ) {
                return true;
            }
            if ( ! preg_match( "/^([a-z0-9]{8})[-](([a-z0-9]{4})[-]){3}([a-z0-9]{12})$/im", $this->code ) ) {
                throw new Exception( esc_html__( 'Invalid code.', 'school-management' ) );
            }
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => "{$this->api_url}?code={$this->code}",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 20,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer B4MNyM1J9pM5JVgb87VcQDZFR1buUiTV",
                    "User-Agent: School Management by Weblizar activation"
                )
            ));
			$response = @curl_exec( $ch );
			if ( curl_errno( $ch ) > 0 ) {
				throw new Exception( esc_html__( 'Failed to query Envato API:', 'school-management' ) . ' ' . curl_error( $ch ) );
			}
			/* Validation */
			$responseCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
			if ($responseCode === 404) {
				throw new Exception( esc_html__( 'The purchase code was invalid.', 'school-management' ) );
			}
			if ($responseCode !== 200) {
				throw new Exception( esc_html__( 'Failed to validate code due to an error: HTTP', 'school-management' ) . " {$responseCode}" );
			}
			$body = json_decode( $response );
			if ( $body->item->id !== $this->item_id ) {
				throw new Exception( esc_html__( 'The purchase code provided is for a different item.', 'school-management' ) );
			}
			update_option( 'wlsm-code', true );
			return true;
		} catch ( Exception $e ) {
			$this->error_message = $e->getMessage();
			return false;
		}
	}
}
