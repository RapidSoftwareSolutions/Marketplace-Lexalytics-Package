<?php

$app->post('/api/Lexalytics/retrieveProcessedDiscoveryByJobId', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret','jobId']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey'=>'api_key','apiSecret'=>'api_secret','jobId'=>'job_id'];
    $optionalParams = ['configId' => 'config_id'];
    $bodyParams = [
       'query' => ['job_id','config_id']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    

    $client = $this->httpClient;
    $query_str = "https://api.semantria.com/collection/processed.json";

    $authRequest = new \Semantria\AuthRequest($data['api_key'],$data['api_secret']);

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);


    if(!empty($requestParams['query']) || isset($requestParams['query']))
    {
        $query_str = $query_str.'?';
        foreach($requestParams['query'] as $key => $value)
        {
            $queryPart = $key.'='.$value;
            $query_str =  $query_str.'&'.$queryPart;
        }

        unset($requestParams['query']);
    }

    $nonce = uniqid('');
    $timestamp = time();
    $query_str = $authRequest->generateQuery('post', $query_str, $timestamp, $nonce);
    $authHeader = $authRequest->generateAuthHeader($query_str, $timestamp, $nonce);

    $requestParams['headers'] = ['Authorization' => $authHeader];

    if(!empty($requestParams['json']['documentBody']))
    {

        if(!empty($requestParams['json']['documentBody'][$key]['jobId']))
        {
            foreach($requestParams['json']['documentBody'] as $key => $value)
            {
                $requestParams['json']['documentBody'][$key]['job_id'] = $requestParams['json']['documentBody'][$key]['jobId'];
                unset($requestParams['json']['documentBody'][$key]['jobId']);
            }
        }

        $jsonArr = $requestParams['json']['documentBody'];
        unset($requestParams['json']['documentBody']);
        $requestParams['json'] = $jsonArr;
    }

    try {
        $resp = $client->get($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});