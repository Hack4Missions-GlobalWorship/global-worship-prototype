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
	} catch (PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	}

	if(empty($keyword) && empty($artform) && empty($language) && empty($genre)) {

	} 
	else {

	}
	

?>
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<form action="search.php">
        <div>Search keywords: <input type="text" name="keyword" id="keyword" class="filter-field"></div>
        <div>Art form: <select name="art_form" id="artForm" class="filter-field"></select></div>
        <div>Language: <select id="language" name="language" class="filter-field"></select></div>
        <div>Genre: <select id="genre" name="genre" class="filter-field"></select></div>
        <input type="submit" value="Submit">
    </form>
    <div id="searchResults"></div>
    <div id="pageNavigation">
        <a><input type="button" value="previous" id="previous" class="input-button"/></a>
        <span id="pageNumbers"></span>
        <a><input type="button" value="next" id="next" class="input-button"/></a>
    </div>
<?php include "footer.php"; ?>
