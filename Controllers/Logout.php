<?php
class Logout
{
	public function __construct()
	{
	}
	public function logout()
	{
		// session_start();
		session_unset();
		session_destroy();
		header('location: ' . base_url());
	}
}
