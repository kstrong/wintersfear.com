<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $title; ?></title>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="wrapper">
	<div class="header">
		<img src="../images/wintersfear-logo.jpg" width="684" height="150" alt="Wintersfear" class="logo">
	</div>
	
	<ul class="nav">
		<li<?php if ($page=="home") echo " class=\"current\""; ?>><a href="/">Home</a></li>
		<li<?php if ($page=="band") echo " class=\"current\""; ?>><a href="/band/">Band</a></li>
		<li<?php if ($page=="music") echo " class=\"current\""; ?>><a href="/music/">Music</a></li>
		<li<?php if ($page=="videos") echo " class=\"current\""; ?>><a href="/videos/">Videos</a></li>
		<li<?php if ($page=="shows") echo " class=\"current\""; ?>><a href="/shows/">Shows</a></li>
		<li<?php if ($page=="contact") echo " class=\"current\""; ?>><a href="/contact/">Contact</a></li>
		<li<?php if ($page=="artwork") echo " class=\"current\""; ?>><a href="/artwork/">Artwork</a></li>
	</ul>
	
	<div  class="content-wrap">
		<div class="hero">
			<img src="../images/hero-<?php echo $page; ?>.jpg" width="940" height="315">
		</div>
		<div class="content">
		