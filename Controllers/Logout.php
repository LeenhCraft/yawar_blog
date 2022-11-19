<?php
class Logout
{
	public function logout()
	{
		session_unset();
		session_destroy();
		header('location: ' . base_url());
	}
}
