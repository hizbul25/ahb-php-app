<?php

$arrData = array(
	1 => array(
			'firstName'	=> 'Hizbul',
			'lastName'	=> 'Bahar',
			'age'		=> 25
		),
	2 => array(
			'firstName'	=> 'Arif',
			'lastName'	=> 'Nayan',
			'age'		=> 26
		),
	3 => array(
			'firstName'	=> 'Abir',
			'lastName'	=> 'Hasan',
			'age'		=> 12
		)
	);

if($arrData[$id]) {
	echo json_encode($arrData[$id]);
}