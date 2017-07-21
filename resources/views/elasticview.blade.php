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
            print_r($response);
        }
        catch (Exception $e) {
            $last = $client->transport->getLastConnection()->getLastRequestInfo();
            $last['response']['error'] = [];
            print_r($last);
        }
    }

    if(isset($index))
    {
        $params = [
            'index' => $index
        ];
        try {
            $response = $client->search($params);
            print_r($response);
        }
        catch (Exception $e)
        {
            $last = $client->transport->getLastConnection()->getLastRequestInfo();
            $last['response']['error'] = [];
            print_r($last);
        }
    }
    
   


    //
    /*$response = $client->index($params);
    print_r($response);*/
?>