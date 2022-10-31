<?php
    /* Defining credentials, server name and database */
    const DB_SERVER = '172.21.0.1';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'docker';
    const DB_NAME = 'loginapp';

    /* Attempt to connect to MariaDB database*/
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
    /* Check connection */
    if (mysqli_connect_errno()) {
        echo "Failed to connect to database: " . mysqli_error();
    }