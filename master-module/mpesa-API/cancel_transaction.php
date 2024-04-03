<?php
session_start();
// Destroy the session.
session_destroy();
// Return a response to the AJAX call.
echo 'Session destroyed';
