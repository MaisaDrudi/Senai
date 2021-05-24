<?php

	require("../process/process.Vendas.php");

	include("configs.php");

	$Vp = new VendasProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$Vp->doGet($_GET);
			break;

		case "POST":
			$Vp->doPost($_POST);
			break;

		case "PUT":
			$Vp->doPut($_PUT);
			break;

		case "DELETE":
			$Vp->doDelete($_DELETE);
			break;
	}