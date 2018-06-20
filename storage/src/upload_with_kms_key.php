<?php
/**
 * Copyright 2018 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/storage/api/README.md
 */

namespace Google\Cloud\Samples\Storage;

# [START upload_with_kms_key]
use Google\Cloud\Storage\StorageClient;

/**
 * Upload a file using KMS encryption.
 *
 * @param string $projectId Your Google Cloud project ID.
 * @param string $bucketName the name of your Google Cloud bucket.
 * @param string $objectName the name of the object.
 * @param string $source the path to the file to upload.
 * @param string $kmsKeyName KMS key ID to use as the default KMS key.
 *
 * @return Psr\Http\Message\StreamInterface
 */
function upload_with_kms_key($projectId, $bucketName, $objectName, $source, $kmsKeyName)
{
    $storage = new StorageClient([
        'projectId' => $projectId,
    ]);
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $objectName,
        'destinationKmsKeyName' => $kmsKeyName,
    ]);
    printf('Uploaded %s to gs://%s/%s using encryption key %s' . PHP_EOL,
        basename($source),
        $bucketName,
        $objectName,
        $kmsKeyName);
}
# [END upload_with_kms_key]
