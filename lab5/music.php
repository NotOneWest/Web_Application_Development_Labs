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
				if(isset($_GET["newspages"])) $news_pages = (int) $_GET["newspages"];
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
				<?php
				$songs = glob("lab5/musicPHP/songs/*.mp3");
				$song_sizes = array();
				foreach ($songs as $song) {
					$song_sizes[$song] = filesize($song);
				}
				arsort($song_sizes);
				foreach($song_sizes as $song => $song_size) {
				?>
				<li class="mp3item">
					<a href="<?=$song?>"><?=basename($song)?></a>
					(<?=(int) ($song_sizes[$song]/1024) ?> KB)
				</li>
			<?php } ?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
				 $playlists = glob("lab5/musicPHP/songs/*.m3u");
				 arsort($playlists);
				 foreach($playlists as $playlist) {
				?>
				<li class="playlistitem"><?=basename($playlist)?></li>
					<ul>
						<?php
						$contents = file($playlist);
						$mp3s = array();
						foreach($contents as $content) {
							if(strpos($content, "#") === false){
								array_push($mp3s, $content);
							}
						}
						shuffle($mp3s);
						foreach ($mp3s as $mp3) {
						?>
						<li><?=$mp3?></li>
					<?php } ?>
					</ul>
				<?php } ?>
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
