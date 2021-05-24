<?php

	require("../process/process.Compras.php");

	include("configs.php");

	$Cp = new ComprasProcess();

	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
			$Cp->doGet($_GET);
			break;

		case "POST":
			$Cp->doPost($_POST);
			break;

		case "PUT":
			$Cp->doPut($_PUT);
			break;

		case "DELETE":
			$Cp->doDelete($_DELETE);
			break;
	}