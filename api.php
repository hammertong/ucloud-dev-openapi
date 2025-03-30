<?php

require 'vendor/autoload.php'; 
require_once '/var/www/html/urmetcloud/tool/cgi/conf/parameters.php';

use Symfony\Component\Yaml\Yaml;

define('API_SPEC_PATH', '/var/www/html/urmetcloud/tool/api.yaml');
define('USER_TAGS_PATH', 'user_tags.yaml');

$user = $_SERVER['REMOTE_USER'] ?? null;
if (!$user) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(["error" => "Accesso negato"]);
    exit;
}

$apiSpec = Yaml::parseFile(API_SPEC_PATH);
$userTagsMapping = Yaml::parseFile(USER_TAGS_PATH);
$allowedTags = $userTagsMapping[$user] ?? [];

$filteredPaths = [];
foreach ($apiSpec['paths'] as $path => $methods) {
    foreach ($methods as $method => $details) {
        if (!isset($details['tags']) || empty(array_intersect($details['tags'], $allowedTags))) {
            continue;
        }
        $filteredPaths[$path][$method] = $details;
    }
}

// Filtra gli schemas in base ai tag consentiti
$filteredSchemas = [];
if (isset($apiSpec['components']['schemas'])) {
    foreach ($apiSpec['components']['schemas'] as $schemaName => $schemaDetails) {
        if ( array_key_exists ("x-tags", $allowedTags)  
            && (!isset($schemaDetails['x-tags']) || empty(array_intersect($schemaDetails['x-tags'], $allowedTags))) ) {
            continue;
        }
        $filteredSchemas[$schemaName] = $schemaDetails;
    }
}

// Ricostruisce lo schema OpenAPI filtrato
$filteredApiSpec = $apiSpec;
$filteredApiSpec['paths'] = $filteredPaths;
$filteredApiSpec['info']['version'] = WEBAPI_VERSION;

header('Content-Type: application/json');
echo json_encode($filteredApiSpec, JSON_PRETTY_PRINT);


