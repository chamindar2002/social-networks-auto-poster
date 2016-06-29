<?php

include __DIR__.'/packages/media/publish/src/FacebookPublisher.php';

use Media\Publish\FacebookPublisher;

$linkToPublish = 'www.mirror.co.uk';
$messageToPublish = 'Mirror News Updates';

$post = new FacebookPublisher();
echo $post->publish($linkToPublish, $messageToPublish);


