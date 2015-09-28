<?php


class CrudController extends AppController
{

	protected $nav_ident = "Crud";

	public function indexAction()
	{
		$this->changeAction('list');

	}

	public function listAction()
	{

	}

	public function addAction()
	{

	}

	public function editAction($id)
	{

	}

	public function deleteAction($id)
	{

	}

	public function refreshAction()
	{
		$this->view = false;

		$item = [
			[
				"id"    => 1,
				"name"  => "Snow, John",
				"email" => "john.snow@got-sample.org.net"
			],

			[
				"id"    => 2,
				"name"  => "Rochemback, Robert",
				"email" => "rochemback.robert@test.com"
			],

			[
				"id"    => 3,
				"name"  => "Doo, Scooby",
				"email" => "dooby.doo@heb.com.br"
			],

			[
				"id"    => 4,
				"name"  => "Bar, Foo",
				"email" => "foo@bar.com"
			]

		];

		echo json_encode($item);
	}

}