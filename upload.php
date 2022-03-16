        <?php
            $message = ""; 
            if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
            {
                // get details of the uploaded file
                $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
                $fileName = $_FILES['uploadedFile']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
            
                // check if file has one of the following extensions
                $forbiddenExtensions = array('sh', 'bat');
            
                if (in_array($fileExtension, $forbiddenExtensions) == FALSE)
                {
                    if ($_POST["passpherese"] == "supersilnehaslo1234567890")
                    {
                        // directory in which the uploaded file will be moved
                        $uploadFileDir = '/srv/http/public/';
                        $dest_path = $uploadFileDir . $fileName;
                    
                        if(move_uploaded_file($fileTmpPath, $dest_path)) 
                        {
                            $message ='File is successfully uploaded.';
                        }
                        else
                        {
                            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                            http_response_code(123);
                            die();
                        }
                    }
                    else 
                    {
                        $message = "Password auth did not went well :0";
                        http_response_code(300);
                        die();
                    }
                }
                else
                {
                    $message = 'Upload failed. Forbiden file types: ' . implode(',', $forbiddenExtensions);
                    http_response_code(100);
                    die();
                }
            }
            else
            {
                $message = 'There is some error in the file upload. Please check the following error.<br>';
                $message .= 'Error:' . $_FILES['uploadedFile']['error'];
            }
            echo $message;
    ?>

