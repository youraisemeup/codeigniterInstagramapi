<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Super-simple, Encryption functions library
 * 
 * @author AppInfini
 * @version 1.0
 */
class Encryption_lib
{


	/**
	 * Create a new instance
	 *
	 */
	function __construct()
	{
        $this->ci =& get_instance();
		$this->ci->load->model('common_model');
	}



	/**
	 * For generating random 6-digit string
	 *
	 * @access	public
	 */
	function generate_verification_code()
	{
		$text1=range('A','N');
		$textKeys1=array_rand($text1,2);
		$text2=range('F','Z');
		$textKeys2=array_rand($text2,1);
		$code=$text1[$textKeys1[0]].rand(1,9).$text1[$textKeys1[1]].rand(10,99).$text2[$textKeys2];
		return $code;
	}
	
	/**
	 * For generating random 6-digit string and finding in database for uniqueness
	 *
	 * @access	public
	 */
	function get_unique_referral_code()
	{
		//Generate code
		$code = $this->generate_verification_code();
		
		//Check if generated code exists in database
		$foundCode = $this->ci->common_model->fetch_data ( 'user_management', 'referral_code', array ( 'where' => array ( 'referral_code' => $code ) ), true );
		
		//If generated code found in database
		if ( count ( $foundCode ) > 0 ) {
			return $this->get_unique_referral_code ();
		} else {
			return $code;
		}
	}
	

}
