<?php

	require("../process/process.Mercadorias.php");

	include("configs.php");

	$Mp = new MercadoriasProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$Mp->doGet($_GET);
			break;

		case "POST":
			$Mp->doPost($_POST);
			break;

		case "PUT":
			$Mp->doPut($_PUT);
			break;

		case "DELETE":
			$Mp->doDelete($_DELETE);
			break;
	}