<?php

	require("../process/process.mercadorias.php");

	include("configs.php");

	$md = new MercadoriasProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$md->doGet($_GET);
			break;

		case "POST":
			$md->doPost($_POST);
			break;

		case "PUT":
			$md->doPut($_PUT);
			break;

		case "DELETE":
			$md->doDelete($_DELETE);
			break;
	}