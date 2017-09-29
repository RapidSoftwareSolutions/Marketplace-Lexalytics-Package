[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Lexalytics/functions?utm_source=RapidAPIGitHub_LexalyticsFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Lexalytics Package
We process billions of unstructured documents every day, globally.We are the industry leader in translating text into profitable decisions; we make state-of-the-art cloud and on-prem text and sentiment analysis technologies that transform customers’ thoughts and conversations into actionable insights.
* Domain: [www.lexalytics.com](https://www.lexalytics.com/)
* Credentials: apiKey, apiSecret

## How to get credentials: 
0. Register on the [www.lexalytics.com](https://www.lexalytics.com/)
1. After registration, you will receive apiKey and apiSecret in account [Dashboard](https:\/\/www.lexalytics.com\/users\/me\/api\/keys)

 ## Custom datatypes: 
  |Datatype|Description|Example
  |--------|-----------|----------
  |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
  |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
  |List|Simple array|```["123", "sample"]``` 
  |Select|String with predefined values|```sample```
  |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```  
  
## Lexalytics.getApiStatus
This method retrieves API status information such as the app version, current API version, supported languages and encodings, the overall service status, etc.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.

## Lexalytics.createDocument
This method queues document onto the server for analysis. Queued document analyzes individually and will have its own set of results. 

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | Identifier of the specific configuration that should be used for processing. 
| id       | String     | Up to 32 symbols unique identifier of document assigned and tracked by client.
| text     | String     | Document text that needs to be analyzed by the service.
| tag      | String     | Any text of up to 50 characters used like marker.”

## Lexalytics.createMultipleDocuments
A batch is an array of documents, each which consists of three values: an optional unique ID, an option tag, and the text you wish to analyze.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| documentBody| Array      | A batch is a list of documents that are pushed to the server in one request. 
| documentBody.id| String      | Up to 32 symbols unique identifier of document assigned and tracked by client. 
| documentBody.text| String      | Document text that needs to be analyzed by the service. 
| documentBody.tag| String     | Any text of up to 50 characters used like marker.
| configId    | String     | Identifier of the specific configuration that should be used for processing. 

## Lexalytics.createDocumentsByJobId
A jobId is not required but can be helpful to separate out content processed via particular environments (dev vs QA) or particular job streams (historical content vs live news).Job_id is only supported by the polling method (not callback or auto response) and if you submit via jobId, you must also retrieve by jobId. You can use only 100 unique jobIds per 24 hour period.If you specified a jobId when submitting you must also specify a jobId when retrieving.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| documentBody| Array      | A batch is a list of documents that are pushed to the server in one request. 
| documentBody.id| String      | Up to 32 symbols unique identifier of document assigned and tracked by client. 
| documentBody.text| String      | Document text that needs to be analyzed by the service. 
| documentBody.tag| String     | Any text of up to 50 characters used like marker.
| documentBody.jobId| String     | Specific marker of incoming job that can be used then for documents retrieving.
| configId    | String     | Identifier of the specific configuration that should be used for processing. 

## Lexalytics.requestSpecificDocuments
Requesting: Asking the status (or processed results) of a specific document.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your API Key.
| apiSecret | credentials| Your API Secret.
| configId  | String     | Optional if the document was processed with the default configuration. Required for non-default configurations.
| documentId| String     | the id of the desired document.

## Lexalytics.retrieveDocuments
This call retrieves as many processed documents as fit into your maximum batch size.By default, the server responds to retrieval requests with 100 documents per batch. To increase this limit, please contact us.Once a document has been retrieved, it will be removed from the Semantria systems.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | Optional if the document was processed with the default configuration. Required for non-default configurations.
| jobId    | String     | The job id.

## Lexalytics.cancelDocumentLoad
Deleting a queued document if Semantria has not processed it yet.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your API Key.
| apiSecret | credentials| Your API Secret.
| documentId| String     | the id of the deleted document.

## Lexalytics.retrieveDocumentsByJobId
If you submitted via jobId, you must also retrieve by that jobId. You cannot use a config_id when retrieving by jobId, although you can use a config_id when submitting with a jobId.This call retrieves as many processed documents as fit into your maximum batch size.By default, the server responds to retrieval requests with 100 documents per batch. To increase this limit, please contact us.Once a document has been retrieved, it will be removed from the Semantria systems.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| jobId    | String     | The job id.

## Lexalytics.createDocumentMetadata
In addition to the required fields, you can also submit metadata about your content. Metadata submissions are allowed only when using the JSON format of the endpoint. No processing of the metadata elements is done by Semantria and the metadata fields will be returned to you with the document when you retrieve it.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| id       | String     | Up to 32 symbols unique identifier of document assigned and tracked by client.
| tag      | String     | Any text of up to 50 characters used like marker
| text     | String     | Document text that needs to be analyzed by the service.
| metadata | JSON       | The metadata field is schema less and can contain any valid JSON you wish to send. You can attach metadata to individual documents and to collections as well.Example - {"testKey":"testValue"}

## Lexalytics.createCollectionOfDocuments
This method submits an list of documents to be analyzed in relation to each other and returns one output. Discovery analysis will contain a summary of sentiment, named entity extraction, themes, and categorization for all the documents in the collection.A collection consists of an array of elements: (optional) ID, (optional) tag and an array of pieces of text.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| id       | String     | Up to 32 symbols unique identifier of document assigned and tracked by client.
| tag      | String     | Any text of up to 50 characters used like marker.
| documents| List       | List of documents text that need to be analyzed by the service.
| configId | String     | ID of config to use.

## Lexalytics.createCollectionOfDocumentsByJobId
This method submits an list of documents to be analyzed in relation to each other and returns one output. Discovery analysis will contain a summary of sentiment, named entity extraction, themes, and categorization for all the documents in the collection.A collection consists of an array of elements: (optional) ID, (optional) tag and an array of pieces of text.You can use a jobId to separate specific environment (such as dev vs QA). Collections submitted with a jobId must be retrieved via that same jobId.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| id       | String     | Up to 32 symbols unique identifier of document assigned and tracked by client.
| tag      | String     | Any text of up to 50 characters used like marker.
| documents| List       | List of the simple strings to be processed as collection.
| configId | String     | ID of config to use.
| jobId    | String     | Specific marker of a job collection belongs to, can be used for collections ordering on client side.

## Lexalytics.retrieveProcessedDiscoveryAnalyses
This method retrieves analysis results for processed collections from Semantria. FAILED collections will have FAILED status in response. Semantria responds with limited amount of results per API call. If configuration ID provided, Semantria responds with the collections, which were queued using the same configuration ID, in opposite Primary configuration uses.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your API Key.
| apiSecret | credentials| Your API Secret.
| configId  | String     | Return processed documents from a particular config id. If the config_id is not provided, the API uses the primary configuration id by default.
| documentId| String     | Return only the document with this ID.

## Lexalytics.retrieveProcessedDiscoveryByJobId
If you submitted by jobId you must also retrieve by jobId.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| jobId    | String     | Return processed documents from a particular job id.

## Lexalytics.requestSpecificDiscoveryAnalysis
Requesting: Asking the status (or processed results) of a specific collection.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| collectionId| String     | The collection id.

## Lexalytics.cancelDiscoveryAnalyses
Deleting a queued document if Semantria has not processed it yet.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| collectionId| String     | The collection id.

## Lexalytics.getExistingConfigurations
The results listing here shows every settable option in a configuration. You do not have to submit all of these values to modify specific values of a configuration.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.

## Lexalytics.createConfigurations
When creating a configuration, only a few fields are mandatory to set. These are:--name--is_primary--language.The complete list of settable values, their types and defaults, see more in readme.

| Field                  | Type       | Description
|------------------------|------------|----------
| apiKey                 | credentials| Your API Key.
| apiSecret              | credentials| Your API Secret.
| name                   | String     | Configuration name.
| isPrimary              | Select     | Identifies whether the current configuration is primary or not. Default: false.
| autoResponse           | Select     | Defines whether or not the service should respond with processed results automatically. Default: false.
| alphanumericThreshold  | Number     | Defines the threshold of alphanumeric characters needed in the text in percent. Default: 80.
| conceptTopicsThreshold | String     | Defines concept topics detection threshold. Default: 0.45.
| entitiesThreshold      | Number     | Defines low threshold for evidence score of named and user entities to be reported in the output. Default: 55.
| oneSentenceMode        | Select     | Defines whether or not service should use one sentence mode with less accurate grammar. Default: false.
| processHtml            | Select     | Defines whether or not the service should clean up HTML tags before processing. Default: false.
| language               | String      | Defines target language that will be used for task processing. Default: English.
| callback               | String      | Defines a callback URL for automatic data responding.
| modelSentiment         | Select     | ConfigurationDocumentSection.Switches on/off model-based sentiment feature. Default: false.
| intentions             | Select     | ConfigurationDocumentSection.Switches on intentions detection feature. Default: false.
| conceptTopics          | Select     | ConfigurationDocumentSection.Defines whether user categories will be reported for the document. Default: false.
| queryTopics            | Select     | ConfigurationDocumentSection.Defines whether queries will be reported for the document. Default: true.
| autoCategories         | Select     | ConfigurationDocumentSection.Defines whether auto-categories will be reported for the document. Default: true.
| namedEntities          | Select     | ConfigurationDocumentSection.Defines whether named entities will be reported for the document. Default: true.
| userEntities           | Select     | ConfigurationDocumentSection.Defines whether user entities will be reported for the document. Default: true.
| themes                 | Select     | ConfigurationDocumentSection.Defines whether document and user/named entity themes will be reported for the document. Default: false.
| mentions               | Select     | ConfigurationDocumentSection.Defines whether mentions for themes and user/named entities will be reported for the document. Default: false.
| relations              | Select     | ConfigurationDocumentSection.Defines whether user/named entity relations will be reported for the document. Default: false.
| opinions               | Select     | ConfigurationDocumentSection.Defines whether user/named entity opinions will be reported for the document. Default: false.
| sentimentPhrases       | Select     | ConfigurationDocumentSection.Defines whether sentiment-bearing phrases will be reported for the document. Default: true.
| posTypes               | String     | ConfigurationDocumentSection.Defines parts-of-speech which will be responded by the server.
| summarySize            | Number     | ConfigurationDocumentSection.Limits the number of sentences for the document summary feature. Default: 3.
| detect_language        | Select     | ConfigurationDocumentSection.Switches on language detection feature. Default: true.
| collectionFacets       | Select     | ConfigurationCollectionSection.Defines whether facets will be reported for the collection. Default: true.
| collectionAttributes   | Select     | ConfigurationCollectionSection.Defines whether facets will be reported for the collection. Default: true.
| collectionMentions     | Select     | ConfigurationCollectionSection.Defines whether mentions for themes, user/named entities, facets and attributes will be reported for the collection. Default: false.
| collectionConceptTopics| Select     | ConfigurationCollectionSection.Defines whether user_categories will be reported for the collection. Default: false.
| collectionQueryTopics  | Select     | ConfigurationDocumentSection.Defines whether queries will be reported for the document. Default: true.
| collectionNamedEntities| Select     | ConfigurationDocumentSection.Defines whether named entities will be reported for the document. Default: true.
| collectionUserEntities | Select     | ConfigurationDocumentSection.Defines whether user entities will be reported for the document. Default: true.
| collectionThemes       | Select     | ConfigurationDocumentSection.Defines whether document and user/named entity themes will be reported for the document. Default: false.

## Lexalytics.updateConfigurations
When creating a configuration, only a few fields are mandatory to set. These are:--name--is_primary--language.The complete list of settable values, their types and defaults, see more in readme.

| Field                  | Type       | Description
|------------------------|------------|----------
| apiKey                 | credentials| Your API Key.
| apiSecret              | credentials| Your API Secret.
| id                     | String     | Enter the ID of the configuration you wish to clone.
| name                   | String     | Configuration name.
| isPrimary              | Select     | Identifies whether the current configuration is primary or not. Default: false.
| autoResponse           | Select     | Defines whether or not the service should respond with processed results automatically. Default: false.
| alphanumericThreshold  | Number     | Defines the threshold of alphanumeric characters needed in the text in percent. Default: 80.
| conceptTopicsThreshold | String     | Defines concept topics detection threshold. Default: 0.45.
| entitiesThreshold      | Number     | Defines low threshold for evidence score of named and user entities to be reported in the output. Default: 55.
| oneSentenceMode        | Select     | Defines whether or not service should use one sentence mode with less accurate grammar. Default: false.
| processHtml            | Select     | Defines whether or not the service should clean up HTML tags before processing. Default: false.
| language               | String      | Defines target language that will be used for task processing. Default: English.
| callback               | String      | Defines a callback URL for automatic data responding.
| modelSentiment         | Select     | ConfigurationDocumentSection.Switches on/off model-based sentiment feature. Default: false.
| intentions             | Select     | ConfigurationDocumentSection.Switches on intentions detection feature. Default: false.
| conceptTopics          | Select     | ConfigurationDocumentSection.Defines whether user categories will be reported for the document. Default: false.
| queryTopics            | Select     | ConfigurationDocumentSection.Defines whether queries will be reported for the document. Default: true.
| autoCategories         | Select     | ConfigurationDocumentSection.Defines whether auto-categories will be reported for the document. Default: true.
| namedEntities          | Select     | ConfigurationDocumentSection.Defines whether named entities will be reported for the document. Default: true.
| userEntities           | Select     | ConfigurationDocumentSection.Defines whether user entities will be reported for the document. Default: true.
| themes                 | Select     | ConfigurationDocumentSection.Defines whether document and user/named entity themes will be reported for the document. Default: false.
| mentions               | Select     | ConfigurationDocumentSection.Defines whether mentions for themes and user/named entities will be reported for the document. Default: false.
| relations              | Select     | ConfigurationDocumentSection.Defines whether user/named entity relations will be reported for the document. Default: false.
| opinions               | Select     | ConfigurationDocumentSection.Defines whether user/named entity opinions will be reported for the document. Default: false.
| sentimentPhrases       | Select     | ConfigurationDocumentSection.Defines whether sentiment-bearing phrases will be reported for the document. Default: true.
| posTypes               | String     | ConfigurationDocumentSection.Defines parts-of-speech which will be responded by the server.
| summarySize            | Number     | ConfigurationDocumentSection.Limits the number of sentences for the document summary feature. Default: 3.
| detect_language        | Select     | ConfigurationDocumentSection.Switches on language detection feature. Default: true.
| collectionFacets       | Select     | ConfigurationCollectionSection.Defines whether facets will be reported for the collection. Default: true.
| collectionAttributes   | Select     | ConfigurationCollectionSection.Defines whether facets will be reported for the collection. Default: true.
| collectionMentions     | Select     | ConfigurationCollectionSection.Defines whether mentions for themes, user/named entities, facets and attributes will be reported for the collection. Default: false.
| collectionConceptTopics| Select     | ConfigurationCollectionSection.Defines whether user_categories will be reported for the collection. Default: false.
| collectionQueryTopics  | Select     | ConfigurationDocumentSection.Defines whether queries will be reported for the document. Default: true.
| collectionNamedEntities| Select     | ConfigurationDocumentSection.Defines whether named entities will be reported for the document. Default: true.
| collectionUserEntities | Select     | ConfigurationDocumentSection.Defines whether user entities will be reported for the document. Default: true.
| collectionThemes       | Select     | ConfigurationDocumentSection.Defines whether document and user/named entity themes will be reported for the document. Default: false.

## Lexalytics.cloneConfigurations
This makes an exact copy of an existing configuration.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| template | String     | Enter the ID of the configuration you wish to clone.
| name     | String     | Name of the new clone.

## Lexalytics.deleteConfigurations
Send a list of config IDs to be deleted.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| deleteIds| List       | List of config IDs to be deleted.

## Lexalytics.getTemplatesList
Get template list.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.

## Lexalytics.getListQueries
Queries are tool to perform precise searches for exact strings or term combination within content. Theyare useful for finding product names, competitor names, specific features, and more. They can also beused for classifying very precise concepts rather than using broad categories.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration you wish to create queries in

## Lexalytics.createQueries
Pass an object within the body of the request with a param.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing queries you wish to list.
| bodyQuery| Array      | List of parametrized objects.
| bodyQuery.name| String      | Query name.
| bodyQuery.query| String     | Query used for content categorization.

## Lexalytics.updateQueries
Pass a JSON-encoded object within the body of the request. A list of query, text key and value pairs. The text of the query submitted will replace an existing query.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing queries you wish to list.
| bodyQuery| Array      | List of parametrized objects.
| bodyQuery.id| String      | Unique query identifier.
| bodyQuery.name| String      | Query name.
| bodyQuery.query| String     | Query used for content categorization.

## Lexalytics.deleteQueries
The delete request allows users to remove queries from the server for a specific configuration.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing queries you wish to list.
| queryList| List       | List of query identifiers.

## Lexalytics.getCategoriesList
Categories are broad tags that the Semantria service intelligently labels content with. Think of them asbuckets into which content is sorted into.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing categories you wish to list.

## Lexalytics.createCategories
The createCategories endpoint allows users to create categories on the server for a specific configuration. 

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Your API Key.
| apiSecret     | credentials| Your API Secret.
| configId      | String     | ID of configuration containing queries you wish to list.
| bodyCategories| Array      | Parameters should be passed within JSON objectList of the categories to be added on the server.
| bodyCategories.name | String      | Category name.
| bodyCategories.weight | String      | Category weight.
| bodyCategories. samples | JSON     | Category  samples.

## Lexalytics.updateCategories
The updateCategories endpoint allows users to update categories on the server for a specific configuration. 

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Your API Key.
| apiSecret     | credentials| Your API Secret.
| configId      | String     | ID of configuration containing queries you wish to list.
| bodyCategories| Array      | Parameters should be passed within JSON objectList of the categories to be update on the server.
| bodyCategories.id| String      | Unique category identifier.
| bodyCategories.name | String      | Category name.
| bodyCategories.weight | String      | Category weight.
| bodyCategories. samples | JSON     | Category  samples.

## Lexalytics.deleteCategories
This method removes certain user categories by their IDs on Semantria side.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Your API Key.
| apiSecret     | credentials| Your API Secret.
| configId      | String     | ID of configuration containing queries you wish to list.
| categoriesList| List       | Parameters should be passed within JSON objectList of the categories to be deleted from the server.

## Lexalytics.getListTaxonomy
Lists the existing taxonomy structure for a given config.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing queries you wish to list.

## Lexalytics.createTaxonomy
Crete a new taxonomy in a given config. Each config can have only one taxonomy defined.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| configId    | String     | ID of config to create the taxonomy in.
| bodyTaxonomy| Array      | Parameters should be passed within JSON objectList of the taxonomy to be added on the server.
| bodyTaxonomy.name | String      | Taxonomy name.
| bodyTaxonomy.enforceParentMatching| Select     | Enforces parent nodes to match on a content if the current node matches
| bodyTaxonomy.nodes| JSON      | The list of sub-nodes associated with the current taxonomy node.
| bodyTaxonomy.topics| JSON      | The list of the topics associated with the current taxonomy node.

Example 
```
[
     {
       "name":"My Taxonomy",
       "nodes": [
         {
           "name":"Sample Node",
           "topics": [
             {
             "id": "607ce795-291f-4dd4-8745-8039f5c40b72",
             "type": "query"
             }
            ]
          }
        ]
      }
   ]
 ```
 
## Lexalytics.updateTaxonomy
To add nodes, or add topics to nodes, specify the relationship in the JSON you submit. You must refer to existing topics and nodes by their ID.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| configId    | String     | ID of config with taxonomy to update.
| bodyTaxonomy| Array      | Parameters should be passed within JSON objectList of the taxonomy to be update on the server.
| bodyTaxonomy.id| String      | Taxonomy id.
| bodyTaxonomy.name | String      | Taxonomy name.
| bodyTaxonomy.enforceParentMatching| Select     | Enforces parent nodes to match on a content if the current node matches
| bodyTaxonomy.nodes| JSON      | The list of sub-nodes associated with the current taxonomy node.
| bodyTaxonomy.topics| JSON      | The list of the topics associated with the current taxonomy node.

Example 
```
[{"id":"5a543ba8-cd7d-4af6-b69f-c99e0836de77", 
"topics":[
    {
      "id":"3fc7692e-996c-421a-a046-c8e2ff314e26", 
      "type":"QUERY"
    }]
}]
 ```
   
## Lexalytics.deleteTaxonomy
This method removes certain taxonomy nodes by their IDs on Semantria side.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API Key.
| apiSecret  | credentials| Your API Secret.
| configId   | String     | ID of configuration containing queries you wish to list.
| taxonomyIds| List       | List of taxonomy node identifiers.

## Lexalytics.getListSentimentPhrases
This method retrieves list of sentiment-bearing phrases available on Semantria side.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing queries you wish to list.

## Lexalytics.createSentimentPhrases
This method adds sentiment-bearing phrases on Semantria side

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your API Key.
| apiSecret | credentials| Your API Secret.
| configId  | String     | ID of config to create the taxonomy in.
| bodyPhrase| Array      | List of parametrized objects.
| bodyPhrase.name| String      | Sentiment-bearing phrase name.
| bodyPhrase.weight| String      | Sentiment-bearing phrase weight.
## Lexalytics.updateSentimentPhrases
This method updates sentiment-bearing phrases by unique IDs on Semantria side.

| Field     | Type       | Description
|-----------|------------|----------
| apiKey    | credentials| Your API Key.
| apiSecret | credentials| Your API Secret.
| configId  | String     | ID of config to create the taxonomy in.
| bodyPhrase| Array      | List of parametrized objects.
| bodyPhrase.id| String      | Unique sentiment-bearing phrase identifier.
| bodyPhrase.name| String      | Sentiment-bearing phrase name.
| bodyPhrase.weight| String      | Sentiment-bearing phrase weight.

## Lexalytics.deleteSentimentPhrases
This method removes certain sentiment-bearing phrases by their names on Semantria side.

| Field              | Type       | Description
|--------------------|------------|----------
| apiKey             | credentials| Your API Key.
| apiSecret          | credentials| Your API Secret.
| configId           | String     | ID of configuration containing queries you wish to list.
| sentimentPhrasesIds| List       | List of sentiment-bearing phrase identifiers.

## Lexalytics.getListEntities
This method retrieves list of user entities available on Semantria side.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing entities you wish to list.

## Lexalytics.createEntities
This method adds user entities on Semantria side.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| configId    | String     | ID of configuration you wish to list entities for.
| bodyEntities| Array      | List of parametrized objects.
| bodyEntities.name| String      | Entity name.
| bodyEntities.type| String      | Type of the entity (Company, Person, any custom type).
| bodyEntities.label| String      | Descriptive label for the entity, e.g. Wikipedia URL.
| bodyEntities.normalized| String      | Normalized form of the entity. Will replace entity name in the output.

## Lexalytics.updateEntities
This method updates user entities by unique IDs on Semantria side.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your API Key.
| apiSecret   | credentials| Your API Secret.
| configId    | String     | ID of configuration you wish to list entities for.
| bodyEntities| Array      | List of parametrized objects.
| bodyEntities.id| String      | Entities id.
| bodyEntities.name| String      | Entity name.
| bodyEntities.type| String      | Type of the entity (Company, Person, any custom type).
| bodyEntities.label| String      | Descriptive label for the entity, e.g. Wikipedia URL.
| bodyEntities.normalized| String      | Normalized form of the entity. Will replace entity name in the output.

## Lexalytics.deleteEntities
This method removes certain user entities by their names on Semantria side.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Your API Key.
| apiSecret  | credentials| Your API Secret.
| configId   | String     | ID of configuration containing entities you wish to list.
| entitiesIds| List       | List of user entity identifiers.

## Lexalytics.getBlacklist
This method retrieves all backlisted items available on Semantria side.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your API Key.
| apiSecret| credentials| Your API Secret.
| configId | String     | ID of configuration containing blacklist you wish to list.

## Lexalytics.createBlacklist
This method adds new unique items to the backlist on Semantria side.

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| Your API Key.
| apiSecret    | credentials| Your API Secret.
| configId     | String     | ID of configuration you wish to list entities for.
| bodyBlacklist| Array      | List of parametrized objects.
| bodyBlacklist.name| String     | Blacklist item name.

## Lexalytics.updateBlacklist
This method updates existing items by unique IDs in the backlist on Semantria side.

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| Your API Key.
| apiSecret    | credentials| Your API Secret.
| configId     | String     | ID of configuration you wish to list entities for.
| bodyBlacklist| Array      | List of parametrized objects.
| bodyBlacklist.id| String     | Unique blacklist item identifier.
| bodyBlacklist.name| String     | Blacklist item name.

## Lexalytics.deleteBlacklistedItem
This method removes certain blacklisted items by their values on Semantria side.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Your API Key.
| apiSecret         | credentials| Your API Secret.
| configId          | String     | ID of configuration containing queries you wish to list.
| blacklistedItemIds| List       | List of user entity identifiers.

