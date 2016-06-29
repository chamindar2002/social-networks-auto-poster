<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 6/28/16
 * Time: 9:13 PM
 *
 */

namespace Media\Publish;

require_once __DIR__.'/../vendor/autoload.php';

use Facebook\Facebook;
use Facebook\FacebookRequest;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

abstract class FacebookPublisherContract
{
    /*
     * The facebook object
     * @var object
     */
    protected $fb;


    /*
     *  access token fetched from facebook after authentication
     *  @var string
     */
    protected $accessToken;

    /*
     * Constructor.
     */

    final public function __construct()
    {

        $config = include('config.php');


        /*
         * innitialize facebook
         */
        $this->fb = new Facebook([
            'app_id' => $config['APP_ID'],
            'app_secret' => $config['APP_SECRET']

        ]);

        /*
         * trigger init() method of derived classes;
         */
        $this->init();
    }

    /**
     * handle and compose error message
     *
     * @return JSON
     */

    final public function handleException($e)
    {

        return json_encode(
            array(
                'stauts'=>'error',
                'message'=> $e->getMessage(),
                'code'=> $e->getCode()
            )
        );


    }

}