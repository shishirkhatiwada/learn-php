//inheritance:  it is a concept of oop where a class is allowed to inherit properties and methods from another class. also known as super class or parent.
// example of inheritance
class Animal {
    public function speak() {
        echo "Animal speaks";
    }
}

class Dog extends Animal {
    public function speak() {
        echo "Dog barks";
    }
}

$dog = new Dog();
$dog->speak(); // Outputs: "Dog barks"


class Employee {
    protected $name;
    protected $address;

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function displayAll() {
        echo "Name: {$this->name}\n";
        echo "Address: {$this->address}\n";
    }
}

class Driver extends Employee {
    private $salary;
    private $post;

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function setPost($post) {
        $this->post = $post;
    }

    public function displayAll() {
        parent::displayAll(); // Call the parent class's displayAll() method
        echo "Salary: {$this->salary}\n";
        echo "Post: {$this->post}\n";
    }
}

// Usage
$driver = new Driver();
$driver->setName("coder are Greatest in the world");
$driver->setAddress("coders world");
$driver->setSalary(5000000.00);
$driver->setPost(" main programmer");
$driver->displayAll();
