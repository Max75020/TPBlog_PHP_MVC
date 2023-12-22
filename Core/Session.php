<?php
namespace Core;

class Session {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // affectation exemple ->set('user', [])
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // récupération exemple ->get('user')
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // récupération exemple ->has('user')
    public function has($key) {
        return isset($_SESSION[$key]);
    }

    // récupération exemple ->remove('user')
    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function clear() {
        session_unset();
    }
}