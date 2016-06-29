<?php
/**
 * Created by PhpStorm.
 * User: chaminda
 * Date: 6/28/16
 * Time: 7:53 PM
 */

namespace Media\Publish;

require_once 'FacebookPublisherContract.php';

use Media\Publish\FacebookPublisherContract;

class FacebookPublisher extends FacebookPublisherContract
{


    public function init()
    {
        /*
         * access token needs to be set dynamically by the user who is using the service.
         * since we are not implementing the user to grant facebook authentication the accces token is hard coded.
         */
        $this->accessToken = 'EAAPgIZBacbTMBAJnVjjmoOW3tjZClqcJDUP3NZB5Dbi72zA2Ix8tE5qviZAE4BF3UqluxlZCLAOnlqe0WYeTXGZBTesuyGPQXb7iPZAC2qOWnX376GvrvZAiO34bcEJ7TYyPqgqV2uLZAkvHD8DkjuPZC7OEpS91ydHnNXbEPpclLSQQZDZD';
    }

    public function publish($link, $message)
    {

            /*
             * prepare the data to be published
             * link attribute is optional
             *
             * @var array
             */
            $linkData = [
                'link' => $link,
                'message' => $message,
            ];


            try {

                /*
                 * make the api call to facebook
                 * Returns a `Facebook\FacebookResponse` object
                 */
                $response = $this->fb->post('/me/feed', $linkData, $this->accessToken);


            } catch(FacebookResponseException $e) {

                return $this->handleException($e);

            } catch(FacebookSDKException $e) {

                return $this->handleException($e);
            }

            $graphNode = $response->getGraphNode();

            //echo 'Posted with id: ' . $graphNode['id'];

            /**
             * compose success response
             *
             * @return JSON
             */
            return json_encode(
                array(
                    'status'=>'success',
                    'message'=> 'Posted with id: ' . $graphNode['id'],
                    'code'=> 200
                )
            );


    }

}