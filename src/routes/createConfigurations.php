<?php

$app->post('/api/Lexalytics/createConfigurations', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey','apiSecret']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey'=>'api_key','apiSecret'=>'api_secret'];
    $optionalParams = ['name'=>'name','isPrimary'=>'is_primary','autoResponse'=>'auto_response','alphanumericThreshold'=>'alphanumeric_threshold','conceptTopicsThreshold'=>'concept_topics_threshold','entitiesThreshold'=>'entities_threshold','oneSentenceMode'=>'one_sentence_mode','processHtml'=>'process_html','language'=>'language','callback'=>'callback','modelSentiment'=>'model_sentiment','intentions'=>'intentions','conceptTopics'=>'concept_topics','queryTopics'=>'query_topics','autoCategories'=>'auto_categories','namedEntities'=>'named_entities','userEntities'=>'user_entities','themes'=>'themes','mentions'=>'mentions','relations'=>'relations','opinions'=>'opinions','sentimentPhrases'=>'sentiment_phrases','posTypes'=>'pos_types','summarySize'=>'summary_size','detect_language'=>'detect_language','collectionFacets'=>'collection_facets','collectionAttributes'=>'collection_attributes','collectionMentions'=>'collection_mentions','collectionConceptTopics'=>'collection_concept_topics','collectionQueryTopics'=>'collection_query_topics','collectionNamedEntities'=>'collection_named_entities','collectionUserEntities'=>'collection_user_entities','collectionThemes'=>'collection_themes'];
    $bodyParams = [
       'json' => ['name','is_primary','auto_response','alphanumeric_threshold','concept_topics_threshold','entities_threshold','one_sentence_mode','process_html','language','callback','model_sentiment','intentions','concept_topics','query_topics','auto_categories','named_entities','user_entities','themes','mentions','relations','opinions','sentiment_phrases','pos_types','summary_size','detect_language','collection_facets','collection_attributes','collection_mentions','collection_concept_topics','collection_query_topics','collection_named_entities','collection_user_entities','collection_themes']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    $documentConfiguration = [
        "model_sentiment",
      "intentions",
      "concept_topics",
      "query_topics",
      "auto_categories",
      "named_entities",
      "user_entities",
      "themes",
      "mentions",
      "relations",
      "opinions",
      "sentiment_phrases",
      "pos_types",
      "summary_size",
      "detect_language"
    ];
    $collectionConfiguration = [
        "facets",
      "attributes",
      "mentions",
      "concept_topics",
      "query_topics",
      "named_entities",
      "themes",
      "user_entities"
    ];

    $client = $this->httpClient;
    $query_str = "https://api.semantria.com/configurations.json";

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


    foreach($documentConfiguration as $key => $value)
    {
      if(!empty($requestParams['json'][$value]))
      {
          $requestParams['json']['document'][$value] = $requestParams['json'][$value];
          unset($requestParams['json'][$value]);
      }
    }

    foreach($collectionConfiguration as $key => $value)
    {
        if(!empty($requestParams['json']['collection_'.$value]))
        {
            $requestParams['json']['collection'][$value] = $requestParams['json'][$value];
            unset($requestParams['json'][$value]);
        }
    }

    $requestParams['json'] = array($requestParams['json']);

    try {
        $resp = $client->post($query_str, $requestParams);
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