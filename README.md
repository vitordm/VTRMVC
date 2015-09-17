# VTRMVC
* A simple PHP MVC Framework
* PHP >= 5.5


## How to use ?

First, use composer... It's simple:

```json
...
"require" {
  "mvc/vtrmvc" : "dev-master"
}
```
Define a JSON configuration file. (Take a look on file "start_sample.json").
But be attention to principal nodes:

```json
{
  ...
  "site_path" : ".",
  "tmp_path" : "./tmp",
  "log_path" : "./tmp/log",
  "mvc" : {
    "path" : "../app",
    ...
  }
  ...
}
```

Define a tree folder where you will put your MVC Code, shoud be:
```
-> FOLDER
--> Controller          # Controllers folder
---> AppController.php 
---> HomeController.php 
--> Model       # Models folder
---> AppModel.php
---> HomeModel.php
--> View        # Views folder
---> Home
----> index.php 
```

After this, you can call the application:
```php
<?php

include "../vendor/autoload.php"; // Composer file

try{

    $url = isset($_GET["_url"]) ? $_GET["_url"] : ""; // URL passing by .htaccess

    $app = new VTRMVC\Core\App();
    $app->start("../public/app.json", $url);


}catch (Exception $ex) {
    VTRMVC\Util\Util::varzx($ex->getMessage());
}
```

## Do you need a sample ?
Please take a good look on "Sample" folder. You'll see how simple it is to do.

:D
