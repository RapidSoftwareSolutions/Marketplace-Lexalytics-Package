<?php
$routes = [
    'metadata',
    'getApiStatus', // 1
    'createDocument', // 1
    'createMultipleDocuments', // 1
    'createDocumentsByJobId', // 1
    'requestSpecificDocuments', // 1
    'retrieveDocuments', // 1
    'cancelDocumentLoad', //0
    'retrieveDocumentsByJobId', // 1
    'createDocumentMetadata', // 1
    'createCollectionOfDocuments', // 1
    'createCollectionOfDocumentsByJobId', // 1
    'retrieveProcessedDiscoveryAnalyses',
    'retrieveProcessedDiscoveryByJobId', // 1
    'requestSpecificDiscoveryAnalysis', // 1
    'cancelDiscoveryAnalyses', // 0
    'getExistingConfigurations', //1
    'createConfigurations', //1
    'updateConfigurations', //1
    'cloneConfigurations',
    'deleteConfigurations', //1
    'getTemplatesList', // 1
    'getListQueries', //1
    'createQueries', // 1
    'updateQueries', // 1
    'deleteQueries', //1
    'getCategoriesList', //1
    'createCategories', //1
    'updateCategories', // 1
    'deleteCategories', // 1
    'getListTaxonomy', //1
    'createTaxonomy', //1
    'updateTaxonomy', // 1
    'deleteTaxonomy', // 1
    'getListSentimentPhrases', //1
    'createSentimentPhrases', // 1
    'updateSentimentPhrases', // 1
    'deleteSentimentPhrases', // 1
    'getListEntities', //1
    'createEntities', //1
    'updateEntities', //1
    'deleteEntities', // 1
    'getBlacklist', //1
    'createBlacklist', //1
    'updateBlacklist', //1
    'deleteBlacklistedItem' //1
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

