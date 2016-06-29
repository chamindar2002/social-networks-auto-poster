<?php

include __DIR__.'/packages/media/publish/src/FacebookPublisher.php';

use Media\Publish\FacebookPublisher;


$post = new FacebookPublisher();



 /*
  * content pool to be published. this could be repalced with data fetched from a database or api feed
  * publishedOn date format d-m-y
  *
  * @var array
  */

$articles = array(

    array(
        'linkToPublish' => null,
        'messageToPublish' => 'A test message without a link',
        'publishOn' => '30-07-2016'
    ),
    array(
        'linkToPublish' => 'http://tunein.com/radio/Sitha-FM-886-s203470/',
        'messageToPublish' => 'Listen to radio',
        'publishOn' => '29-06-2016'
    ),
    array(
        'linkToPublish' => null,
        'messageToPublish' => 'Another test message without a link',
        'publishOn' => '03-07-2016'
    ),
    array(
        'linkToPublish' => 'www.yahoo.com',
        'messageToPublish' => 'Yahoo',
        'publishOn' => '04-07-2016'
    ),
    array(
        'linkToPublish' => 'https://www.youtube.com/watch?v=pvAsqPbz9Ro',
        'messageToPublish' => 'A Youtube Video',
        'publishOn' => '05-07-2016'
    ),
    array(
        'linkToPublish' => 'www.vimeo.com',
        'messageToPublish' => 'Vimeo',
        'publishOn' => '06-07-2016'
    ),
    array(
        'linkToPublish' => 'http://50.17.179.86/',
        'messageToPublish' => 'Allison',
        'publishOn' => '29-06-2016'
    )




);

/*
 * api response summary
 *
 * @var array
 */
$results = array('success'=>0,'failed'=>0);

foreach($articles As $key=>$article)
{
    /*
     * today's time stamp
     */
    $today = strtotime(date('d-m-Y'));

    /*
     * filter only qualifying posts
     */
    if($today == strtotime($article['publishOn']))
    {
        print "posting ".$article['messageToPublish']."\n";
        $response = json_decode($post->publish($article['linkToPublish'], $article['messageToPublish']));

        if($response->status == 'success'){
            $results['success']++;
            print "success \n";
        }else{
            $results['failed']++;
            print "failed \n";
        }

        /*
         * pause to prevent bombardment of service calls too frequently
         */
        sleep(1);
    }

}

print "successful ".$results['success']." failed ".$results['failed']." \n";