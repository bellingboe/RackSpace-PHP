<?php

require_once "RS.inc.php";
require_once "RS_Service.inc.php";
require_once "RS_CloudFilesService.inc.php";
require_once "RSContainer.inc.php";

/*
 * Create a container with meta data
 * */
$c = RS::container();
$c->create("MY_CONTAINER_NAME");
$c->auth_client();
$c->setMetadata(array("Author" => "Some User"));

/*
 * Set the size limit of the container
 * */
$cont = $c->get();
$cont->setBytesQuota(1024);

// ====================================================================== //

/*
 * Get a "cloudFiles" instance
 * */
$container_name = "conainer_1";
$remote_store = RS::container()->load($container_name);

// ====================================================================== //

/*
 * Upload a file
 * */

/*
@param $rs_fn - the filename to appear in RackSpace
@param $obj_data - the binary data to send to the remote container
@param $meta_data - an optional assocative array for any meta data.
*/
// use fopen() to read the data of the file to upload
$file_data = fopen($fp, 'r+');
$file = $remote_store->upload($file_name, $rs_data, array("Uploaded-By" => "SOME_USER_ID"));

// ====================================================================== //

/*
 * Get bytes used by container
 * */
$remote_store->bytesUsed();

// ====================================================================== //

/*
 * Get a file from the container based on file name
 * */
$file_name = "myfile.jpg";
$remote_store->o($file_name);

// ====================================================================== //

/*
 * Delete a file in the container based on the file anem specified on upload
 * */
$file_name = "myfile.jpg";
$remote_store->o($file_name)->oDelete();

