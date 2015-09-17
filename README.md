# VTRMVC
A simple PHP MVC Framework

## How to use ?

First, use composer... It's simple:

```
...
"require" {
"html/html-helpr" : "dev-master"
}
```
Define a JSON configuration file. (Take a look on file "start_sample.json").
But be attention to principal nodes:

```
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
```
<?php

include "../vendor/autoload.php"; // Composer file

try{

    $url = isset($_GET["_url"]) ? $_GET["_url"] : ""; // URL passing by .htacess

    $app = new VTRMVC\Core\App();
    $app->start("../public/app.json", $url);


}catch (Exception $ex) {
    VTRMVC\Util\Util::varzx($ex->getMessage());
}
```
