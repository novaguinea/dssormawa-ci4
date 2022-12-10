<?php

require_once 'vendor/google/autoload.php';
// require __DIR__ . '/vendor/autoload.php';   

$client = new Google\Client();
$client->setClientId("481706310378-vk835okkldn1bpi4sspr3rjfiur1vn9k.apps.googleusercontent.com");
$client->setClientSecret("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");
// Your redirect URI can be any registered URI, but in this example
// we redirect back to this same page
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client->setRedirectUri($redirect_uri);

$client->addScope(Google\Service\Drive::DRIVE);

// create the datastore service class
$datastore = new Google\Service\Datastore($client);

// build the query - this maps directly to the JSON
$query = new Google\Service\Datastore\Query([
    'kind' => [
        [
            'name' => 'Book',
        ],
    ],
    'order' => [
        'property' => [
            'name' => 'title',
        ],
        'direction' => 'descending',
    ],
    'limit' => 10,
]);

// build the request and response
$request = new Google\Service\Datastore\RunQueryRequest(['query' => $query]);
$response = $datastore->projects->runQuery('YOUR_DATASET_ID', $request);


// https://developers.google.com/drive/api/v2/reference/files/insert
function insertFile($service, $title, $description, $parentId, $mimeType, $filename)
{
    $file = new Google\Service\Google_Service_Drive_DriveFile();
    $file->setTitle($title);
    $file->setDescription($description);
    $file->setMimeType($mimeType);

    // Set the parent folder.
    if ($parentId != null) {
        $parent = new Google\Service\Google_Service_Drive_ParentReference();
        $parent->setId($parentId);
        $file->setParents(array($parent));
    }

    try {
        $data = file_get_contents($filename);

        $createdFile = $service->files->insert($file, array(
            'data' => $data,
            'mimeType' => $mimeType,
        ));

        // Uncomment the following line to print the File ID
        // print 'File ID: %s' % $createdFile->getId();

        return $createdFile;
    } catch (Exception $e) {
        print "An error occurred: " . $e->getMessage();
    }
}


// $client->setApplicationName("dss-ormawa-upnvj");
// $client->setDeveloperKey("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");
// $client->setAuthConfig('/path/to/client_credentials.json');

// $service = new Google\Service\Books($client);
// $query = 'Henry David Thoreau';
// $optParams = [
//     'filter' => 'free-ebooks',
// ];
// $results = $service->volumes->listVolumes($query, $optParams);

// foreach ($results->getItems() as $item) {
//     echo $item['volumeInfo']['title'], "<br /> \n";
// }

?>