<?php
namespace App;

trait GreetingTrait {
    public function sayHello() {
        return "Hello, welcome to the PHP OOP example!";
    }
}

abstract class User {
    protected $name;
    protected $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    abstract public function getRole();
}

class Admin extends User {
    use GreetingTrait;

    private $level;

    public function __construct($name, $email, $level) {
        parent::__construct($name, $email);
        $this->level = $level;
    }

    public function getRole() {
        return "Admin";
    }

    public function __toString() {
        return "Name: {$this->name}, Email: {$this->email}, Role: {$this->getRole()}, Level: {$this->level}";
    }
}

class Member extends User {
    use GreetingTrait;

    private $membershipType;

    public function __construct($name, $email, $membershipType) {
        parent::__construct($name, $email);
        $this->membershipType = $membershipType;
    }

    public function getRole() {
        return "Member";
    }

    public function __toString() {
        return "Name: {$this->name}, Email: {$this->email}, Role: {$this->getRole()}, Membership Type: {$this->membershipType}";
    }
}

$admin = new Admin("Verry", "Verry@yahoo.com", "Super");
$member = new Member("Paijo", "paijo@yahoo.com", "Gold");

echo $admin->sayHello() . "\n";
echo $admin . "\n";
echo $member . "\n";
