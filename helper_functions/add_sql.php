<?php

function execute($sql, $params) {
  require_once("../database.php");

  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    die("Preparation failed " . $conn->error);
  }

  call_user_func_array([$stmt, 'bind_param'], $params);

  if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();

}

function add_employee($forename, $surname, $email, $team) {
  $sql = "INSERT INTO Employees (forename, surname, email, team) VALUES (?, ?, ?, ?)";
  $params = [
    "sssi",
    $forename,
    $surname,
    $email,
    $team
  ];

  execute($sql, $params);
}



function add_role($employee_id, $role) {
  $sql = "INSERT INTO Roles (employee_id, role) VALUES (?, ?)";
  $params = [
    "ii",
    $employee_id,
    $role
  ];
  execute($sql, $params);
}

function add_registration($email, $password) {
  $sql = "INSERT INTO Registrations (email, password) VALUES (?, ?)";
  $params = [
    "ss",
    $email,
    $password
  ];

  execute($sql, $params);
}

function add_task($name, $description, $category, $due) {
  $sql = "INSERT INTO Tasks (name, description, category, due) VALUES (?, ?, ?, ?)";
  $params = [
    "ssis",
    $name,
    $description,
    $category,
    $due
  ];

  execute($sql, $params);
}

function add_assignment($task_id, $employee_id) {
  $sql = "INSERT INTO Assignments (task_id, employee_id) VALUES (?, ?)";
  $params = [
    "ii",
    $task_id,
    $employee_id
  ];

  execute($sql, $params);
}

