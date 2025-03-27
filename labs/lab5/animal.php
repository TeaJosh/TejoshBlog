<?php

class Animal {
    protected $name;
    protected $legs;
    protected $type;
    protected $food;
    protected $environment;

    public function __construct($name, $legs, $type, $food, $environment) {
        $this->name = $name;
        $this->legs = $legs;
        $this->type = $type;
        $this->food = $food;
        $this->environment = $environment;
    }

    public function create() {
        echo "Name: $this->name<br/>";
        echo "Legs: $this->legs<br/>";
        echo "Type: $this->type<br/>";
        echo "Food: $this->food<br/>";
        echo "Environment: $this->environment<br/>";
    }
}

trait Talk {
    public function sing($sound) {
        echo "This $this->type talks with a $sound.<br/>";
    }
}

trait Walk {
    public function move() {
        echo "This $this->type walks and runs on $this->legs legs.<br/>";
    }
}

class Cat extends Animal {
    use Talk, Walk;
    protected $color;
    protected $fur;
    protected $age;

    public function __construct($name, $legs, $food, $environment, $color, $fur, $age) {
        parent::__construct($name, $legs, "Cat", $food, $environment);
        $this->color = $color;
        $this->fur = $fur;
        $this->age = $age;
    }

    public function move() {
        echo "Walking on all $this->legs with my $this->type!<br/>";
    }

    public function sing($song) {
        echo "Singing $song with my Cat!<br/>";
    }

    public function create() {
        parent::create();
        echo "Color: $this->color<br/>";
        echo "Fur: $this->fur<br/>";
        echo "Age: $this->age<br/>";
    }
}

class Dog extends Animal {
    use Walk;
    protected $color;
    protected $age;

    public function __construct($name, $legs, $food, $environment, $color, $age) {
        parent::__construct($name, $legs, "Dog", $food, $environment);
        $this->color = $color;
        $this->age = $age;
    }

    public function move() {
        echo "Running on all $this->legs with my $this->type $this->name!<br/>";
    }

    public function create() {
        parent::create();
        echo "Color: $this->color<br/>";
        echo "Age: $this->age<br/>";
    }
}

class Lion extends Animal {
    use Talk, Walk;
    protected $color;
    protected $age;
    protected $teeth;
    protected $claws;

    public function __construct($name, $legs, $food, $environment, $color, $age, $teeth, $claws) {
        parent::__construct($name, $legs, "Lion", $food, $environment);
        $this->color = $color;
        $this->age = $age;
        $this->teeth = $teeth;
        $this->claws = $claws;
    }

    public function move() {
        echo "Walking on all $this->legs and Eating my meal with my $this->teeth teeth!<br/>";
    }

    public function sing($song) {
        echo "Singing $song with my $this->type $this->name!<br/>";
    }

    public function create() {
        parent::create();
        echo "Color: $this->color<br/>";
        echo "Age: $this->age<br/>";
        echo "Teeth: $this->teeth<br/>";
        echo "Claws: $this->claws<br/>";
    }
}
?>
