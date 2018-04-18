<?php

include "settings.php";
//VERIFY LOGIN
session_start();

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

if(!isset($_SESSION["userid"]))
{
  $_SESSION["invalid"] = "Invalid Login. Please try again";

    redirect("login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hayden Redford</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h2>Welcome to my DBA Site.</h2>
<a href="logout.php"> log out </a>
<h3>MySQL Database</h3>
<p>Below is a link to view the status and usage summary of WIAB's MySQL database.</p>
<p>The data is as recent as the time of the page load. There is also an option to back up this datbase.</p>
 
<a href="mysql.php"><button>Go to MySQL page</button></a>
<br>
<br>
<h3>Mongo Database</h3>
<p>Below is a link to view the status and usage summary of WIAB's Mongo database, used to store user reviews.</p>
<p>The data is as recent as the time of the page load. There is also an option to back up this datbase.</p>

<a href="mongo.php"><button>Go to Mango page</button></a>
<br>
<br>
<h3>Elasticsearch (ELK)</h3>
<p>Below is a link to view a Kibana Dashboard to show Elasticsearch results.</p>
<p>Elasticsearch is being used to analyze MySQL logs, including slow logs, using the ELK stacks.</p>

<a href="http://localhost:5601/app/kibana#/dashboard/Filebeat-MySQL-Dashboard?_g=()&_a=(description:'Overview%20dashboard%20for%20the%20Filebeat%20MySQL%20module',filters:!(),fullScreenMode:!f,options:(darkTheme:!f,useMargins:!f),panels:!((embeddableConfig:(vis:(params:(sort:(columnIndex:!n,direction:!n)))),gridData:(h:4,i:'1',w:6,x:0,y:7),id:MySQL-slowest-queries,panelIndex:'1',type:visualization,version:'6.2.3'),(gridData:(h:3,i:'2',w:6,x:0,y:0),id:MySQL-Slow-queries-over-time,panelIndex:'2',type:visualization,version:'6.2.3'),(gridData:(h:3,i:'3',w:6,x:6,y:0),id:MySQL-error-logs,panelIndex:'3',type:visualization,version:'6.2.3'),(columns:!(mysql.error.level,mysql.error.message),gridData:(h:5,i:'4',w:6,x:6,y:7),id:Filebeat-MySQL-error-log,panelIndex:'4',sort:!('@timestamp',desc),type:search,version:'6.2.3'),(gridData:(h:4,i:'5',w:6,x:6,y:3),id:MySQL-Error-logs-levels,panelIndex:'5',type:visualization,version:'6.2.3'),(gridData:(h:4,i:'6',w:6,x:0,y:3),id:MySQL-Slow-logs-by-count,panelIndex:'6',type:visualization,version:'6.2.3')),query:(language:lucene,query:(query_string:(analyze_wildcard:!t,default_field:'*',query:'*'))),timeRestore:!f,title:'%5BFilebeat%20MySQL%5D%20Overview',viewMode:view)"><button>Go to Elasticsearch page</button></a>
<br>

<p>*database queries are accessed via python scripts.</p>
</body>
</html>
<?php 
mysqli_close($conn);
?>