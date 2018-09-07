<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('php/main.php');

$main = new main(true);

// Get older projects to display
$projects = $main->getProjects();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("metatags.html") ?>
	<meta name="robots" content="index, follow" />

	<title>Project list</title>

	<link rel="stylesheet" href="<?=$main->version("css/style.css")?>">

	<!-- Favicons -->
	<?php include("favicons.html") ?>
</head>
<body>
	<!-- Google Analytics -->
	<?php include_once("analytics.html") ?>

	<!-- Header -->
	<?php require("components/header.php") ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title">
			<h1>Projects list</h1>
		</div>
	</div>

    <?php foreach ($projects as $project): ?>
        <div class="card">
            <h2><?=$project["opc_name"]?></h2>
            <ul class="first">
                <?php foreach ($project["projects"] as $item): ?>
                    <li><a target="_blank" href="<?=$item["old_project_url"]?>"><?=$item["old_project_name"]?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php foreach ($project["opc_links"] as $link): ?>
                <a class="button" target="_blank" href="<?=$link["opcl_url"]?>"><?=$link["opcl_name"]?></a>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

	<!-- Footer -->
	<?php require("components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=$main->version("js/main.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
