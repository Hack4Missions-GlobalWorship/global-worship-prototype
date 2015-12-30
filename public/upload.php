<?php include "header.php"; ?>

<script language="javascript">
	function addFile() {
		/*
		Adds button for uploader to add new files.
		I wasn't able ot get this done, but each time a new button is created, a new ID needs to be created.
		*/
		var d1 = document.getElementById('buttons');
		d1.insertAdjacentHTML('beforeend', '<input type="file">'+
			'<select><option value = "song">Music (.mp3, .wav)</option><option value = "video">Video (.mp4)</option>' + //file types
			'<option value = "art">Art/Lyrics/Sheet Music (.jpg, .pdf)</option></select>' + 
			'<select style="margin-left:50px; margin-right:50px"><option value = "english">English</option><option value = "turkish">Turkish</option></select>' + //needs to be populated with languages from database. I temporarily hardcoded in English and Turkish
			'Amazon Link:<input style="margin-right:50px;" type="text" name = "amazonLink">' + //amazon purchase link
			'iTunes Link:<input type="text" name = "iTunesLink"><br>'); //iTunes purchase link
	}
</script>

	<h1>Upload</h1>

	<h2>General</h2>

	<form>
		Project Name:
		<input type="text" class="filter-field" name = "projectname">
		<br><br>
	</input>

	Song Title:
	<input type="text" class="filter-field" name = "songtitle">
	<br><br>
	
	Artist:
	<input type="text" class="filter-field" name = "artist">
	<br><br>

	Genre:
	<input type="text" class="filter-field" name = "genre">
	<br><br>
	
	Theme:
	<input type="text" class="filter-field" name = "theme">
	<br><br>

	<h2>Location</h2>

	Continent:
	<select class="filter-field" >
		<option value = "africa">Africa</option>
		<option value = "antarctica">Antarctica</option>
		<option value = "asia">Asia</option>
		<option value = "australia">Australia</option>
		<option value = "europe">Europe</option>
		<option value = "northamerica">North America</option>
		<option value = "southamerica">South America</option>
	</select>
	<br><br>

	Country:
	<select class="filter-field" >
		<option value = "turkey">Turkey</option>
		<option value = "unitedstates">United States</option>
	</select>
	<br><br>

	Region:
	<input type="text" class="filter-field" name = "region">
	<br><br>

	<h2>File(s)</h2>

	<input onclick="addFile()";  type="button" class="input-button" value= "Add File">
	<div  id="buttons"></div>
	<br>

	<h2>Other</h2>

	Tagwords (separate by commas):
	<input type="text" class="filter-field" name = "tags">
	<br><br>

	Copyright: <!-- Need to find copyright options and populate dropdown-->
	<select class="filter-field" >
		<option value = "sample">Sample</option>
	</select>
	<br><br>

	Publisher:
	<input type="text" class="filter-field" name = "publisher">
	<br><br>

	iTunes Link:
	<input type="text" class="filter-field" name = "iTunesLink">
	<br><br>

	Amazon Link:
	<input type="text" class="filter-field" name = "amazonLink">
	<br><br>

	<input type="submit" class="input-button">

</form>

<?php include "footer.php"; ?>
