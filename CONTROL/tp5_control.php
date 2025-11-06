<?php
class tp5_control
{
    public function existeSession()
    {
        @session_start();
        return isset($_SESSION['username']) && isset($_SESSION['password']);
    }
}
