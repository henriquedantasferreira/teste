<?php
    require '/var/www/html/vendor/autoload.php';

    $hosts = [
        [
            'host' => '172.17.0.3'
        ]
    ];

    $client = Elasticsearch\ClientBuilder::create()           // Instantiate a new ClientBuilder
                    ->setHosts($hosts)      // Set the hosts
                    ->build();              // Build the client object

    if(isset($addindex))
    {
         $params = [
            'index' => $addindex,
            'type' => $type,
            'id' => $id,
            'body' => ['testField' => $body]
        ];


        try {
            $response = $client->index($params);
            echo "<pre>";
            print_r($response);
            echo "</pre>";
        }
        catch (Exception $e) {
            $last = $client->transport->getLastConnection()->getLastRequestInfo();
            $last['response']['error'] = [];
            print_r($last);
        }
    }

    if(isset($searchindex))
    {
        $params = [
            'index' => $searchindex
        ];
        try {
            $response = $client->search($params);
            echo "<pre>";
            print_r($response);
            echo "</pre>";
        }
        catch (Exception $e)
        {
            echo "Index not found...";
            /*$last = $client->transport->getLastConnection()->getLastRequestInfo();
            $last['response']['error'] = [];
            print_r($last);*/
        }
    }
    
   if(isset($deleteindex))
    {
        $params = [
            'index' => $deleteindex
        ];
        try {
            $response = $client->indices()->delete($params);
            echo "<pre>";
            print_r($response);
            echo "</pre>";
        }
        catch (Exception $e)
        {
            $last = $client->transport->getLastConnection()->getLastRequestInfo();
            $last['response']['error'] = [];
            print_r($last);
        }
    }
?>