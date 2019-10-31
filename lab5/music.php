<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<?php
		$song_count=5678;
		$song_hour = $song_count/10;
		print
		"<p>
			I love music.
			I have $song_count total songs,
			which is over " . (int) $song_hour . " hours of music!
		</p>"
		?>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
			<ol>
				<?php
				$news_pages = 5;
				if (isset($_GET["newspages"])) $news_pages = (int) $_GET["newspages"];
				$year=2019;
				$month=11;
				for($i = 0; $i < $news_pages; $i++) {
					$temp=$month;
					if($month<10) $temp="0$month";
				?>
				<li><a href="https://www.billboard.com/archive/article/<?=$year . $temp?>"><?="$year-$temp"?></a></li>
				<?php $month--;
					if($month === 1){
						$year-=1;
						$month=12;
					}
				} ?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
			<ol>
				<?php
				// $artists = array(
				// 	"Guns N' Roses",
				// 	"Green Day",
				// 	"Blink 182",
				// 	"Queen"
				// );
				// foreach($artists as $artist) {
				// 	print "<li>$artist</li>";
				// }
				$lines = file("./favorite.txt");
				foreach ($lines as $line) {
					$temp = explode(' ', $line);
					$link = implode('_', $temp);
				?>
				<li><a href="https://en.wikipedia.org/wiki/<?=$link?>"><?=$line?></a></li>
				<?php } ?>
			</ol>
		</div>

		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<li class="mp3item">
					<a href="musicPHP/songs/paradise-city.mp3">paradise-city.mp3</a>
				</li>

				<li class="mp3item">
					<a href="musicPHP/songs/basket-case.mp3">basket-case.mp3</a>
				</li>

				<li class="mp3item">
					<a href="musicPHP/songs/all-the-small-things.mp3">all-the-small-things.mp3</a>
				</li>

				<!-- Exercise 8: Playlists (Files) -->
				<li class="playlistitem">326-13f-mix.m3u:
					<ul>
						<li>Basket Case.mp3</li>
						<li>All the Small Things.mp3</li>
						<li>Just the Way You Are.mp3</li>
						<li>Pradise City.mp3</li>
						<li>Dreams.mp3</li>
					</ul>
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
