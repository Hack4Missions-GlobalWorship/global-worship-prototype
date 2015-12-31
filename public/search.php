<?php 
	include "header.php"; 
	
	$keyword=htmlspecialchars($_GET["keyword"]);
	$artform=htmlspecialchars($_GET["art_form"]);
	$language=htmlspecialchars($_GET["language"]);
	$genre=htmlspecialchars($_GET["genre"]);

	$dsn = 'mysql:host=globalmissions.c8fufuz88xej.us-west-2.rds.amazonaws.com;port=3306;dbname=ethnos';
	$username = 'gwi';
	$password = 'gwi-123!';

	try {
	    $dbh = new PDO($dsn, $username, $password);
	    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    if(!isset($keyword)) {
                //do nothing since no data was given
            }
            else {
		//$keyword=mysql_real_escape_string($keyword);
		$artform=mysql_real_escape_string($artform);
		$language=mysql_real_escape_string($language);
		$genre=mysql_real_escape_string($genre);
                //$stmt = $conn->prepare("SELECT id, name, composer from File where art_form='$artform' and language='$language' and genre='$genre'");
		//$stmt = $dbh->prepare("SELECT File.id, File.name, Composer.name from File, Composer where Composer.name like '%{$keyword}%' and composer_id=Composer.id");
                //$stmt = $dbh->prepare("SELECT File.id, File.song_name, File.amazon_link from File limit 4, 11");
		$stmt = $dbh->prepare("SELECT File.id, File.song_name, File.amazon_link from File where File.song_name like '%{$keyword}%' and File.amazon_link is not NULL");
		//$stmt = $dbh->prepare("SELECT File.id, File.song_name, File.amazon_link from File where File.song_name like '$keyword'");

                $stmt->execute();
		$result = $stmt->fetchAll();
	    }
	} catch (PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	}
?>
<html>
  <head>
    <style type="text/css">
      td {
      border-right: 10px solid transparent;
      -webkit-background-clip: padding;
      -moz-background-clip: padding;
      background-clip: padding-box;
      }
    </style>
  </head>
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
  <link href="css/search.css" rel="stylesheet">
    <div class="wrapper">
      <h2>Search</h2>
      <form action="search.php">
        <div class="container">
          <div class="col-1of2 col-left">
            <div class="form-div">
              <span>Keywords</span>
              <br/>
              <input type="text" name="keyword" id="keyword" class="filter-field">
            </div>
            <div class="form-div">
              <span>Art form</span>
              <br/>
              <select name="art_form" id="artForm" class="filter-field"></select>
            </div>
          </div>
          <div class="col-1of2 col-right">
            <div class="form-div">
              <span>Language</span>
              <br/>
              <select id="language" name="language" class="filter-field"></select>
            </div>
            <div class="form-div">
              <span>Genre</span>
              <br/>
              <select id="genre" name="genre" class="filter-field"></select>
            </div>
          </div>
        </div>
        <input type="submit" value="Submit" class="input-button">
        </form>
      <div id="searchResults">
        <table>
          <tr>
            <th>ID</th>
            <th>Language</th>
            <th>Song Name</th>
          </tr>
          <?php  foreach ($result as $row): ?>
          <tr>
            <td>
              <?=htmlspecialchars($row['id'])?>
            </td>
            <td>Manainkan</td>
            <td>
              <a href=""
                <?=htmlspecialchars($row['amazon_link'])?>><?=htmlspecialchars($row['song_name'])?>
              </a>
            </td>
          </tr>
          <?php endforeach ?>
        </table>
</div>
      <div id="pageNavigation">
        <a>
          <input type="button" value="previous" id="previous" />
        </a>
        <span id="pageNumbers"></span>
        <a>
          <input type="button" value="next" id="next" />
        </a>
      </div>
    </div>

  <br>

      </html>
  <?php include "footer.php"; ?>   
