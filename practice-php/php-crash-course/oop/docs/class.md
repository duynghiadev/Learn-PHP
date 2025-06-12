# 1 Classes

In this lesson, we're going to learn about classes, how they're defined, how they're instantiated, and how those instances are used.

We'll be covering the following in this lesson:

1. [Classes](#1-classes)
   1. [Class Definitions](#11-class-definitions)
   2. [Object Instantiation](#12-object-instantiation)
      1. [The new keyword](#121-the-new-keyword)
      2. [The clone keyword](#122-the-clone-keyword)
   3. [Operators](#13-operators)
      1. [Object operator](#131-object-operator)
      2. [Class operator](#132-class-operator)
   4. [Methods](#14-methods)
      1. [Instance Methods](#141-instance-methods)
      2. [Static Methods](#142-static-methods)
      3. [Method Visibility](#143-method-visibility)
         - [Public](#1431-public)
         - [Protected](#1432-protected)
         - [Private](#1433-private)
      4. [Final Methods](#144-final-methods)
      5. [Magic Methods](#145-magic-methods)
   5. [Properties](#15-properties)
      1. [Class Variables](#151-class-variables)
      2. [Instance Variables](#152-instance-variables)
      3. [Property Visibility](#153-property-visibility)
         - [Public](#1531-public)
         - [Protected](#1532-protected)
         - [Private](#1533-private)
   6. [Constants](#16-constants)

## 1.1 Class Definitions

A class is what is known as a _non-primitive_ type. In PHP we have primitive types, which are defined by the language, such as an `integer`, a `float`, a `string`, a `boolean`, an `array`, a `null`, a `resource`, or an `object`. Since classes are defined types they hold a distinct classification of the primitive type object. Meaning that a class with the name `Foo` is considered to be a of type `Foo`.

You can think of this in the same sense that you classify living things. For example, a _whale_ is a type of _mammal_. If the living thing is considered an object, then it's type is considered as a class or classification. So you can think of the variable name as a way to name or reference the living thing. You can then think of the class name as the distinguishing type that classifies the living thing.

So using this analogy we can write the following code...

```PHP
    <?php
    $whale = new Mammal;
```

Where `$whale` is the name of the variable (or living thing) and `Mammal` is the type of living thing we're describing.

This analogy will make more sense later when we learn about inheritance in the next lesson. For now, know that classes define types of things.

Classes in PHP are defined by using the `class` keyword, followed by a valid name identifier, such as `Foo`, followed by an opening curly brace `{`, followed by a closing curly brace `}`. Everything between the curly braces is said to be the _body_ of the class. The body of a class is made up of two key parts: the _class initializors_ and the _function definitions_. Each of these parts are made up of what is commonly referred to as _class members_.

Initializors are exactly what they sound like. They initialize properties, variables, and constants. Here you can also declare what are called _visibility specifiers_, which we'll learn more about later. For now, know that they merely tell us to which parts of our code a given member is made visible (or accessible).

Function definitions make up what we call the class methods. Methods are just like normal functions in PHP and are declared in the same way. The only difference is that class methods can take on additional characteristics such as visibility specifiers, static declarations, and final declarations, which we'll learn more about later in this lesson.

So an example of a very basic class definition would be as follows...

```PHP
    <?php
    class Foo {
        /* class body here */
    }
```

This class has an empty body, because classes are not required to define properties or methods. An empty class definition is said to be a method-less class.

In a class, methods allow us to define behaviors, and properties allow us to describe some of those behaviors. So for example, if we wanted to represent a person as a class, we might give that person the behavior of `growing`, and describe the growth through `age`.

The class definition for this person then would looks something like this...

```PHP
    <?php
    class Person {
        public $age = 0;

        public function grow($years = 1) {
            $this->age += $years;
        }
    }
```

As you can see the action of growing the person creates a mutated state of the object (_i.e. it changes the value of the property `age`_). This is called a behavior and it is typically achieved through a method. The actual understanding of `Person`'s age is achieved through reading the property `age`. This is why it's called a property.

So to sum up what we've learned so far we can say that a class is made up of any number of methods, properties, and constants. Classes are non-primitive types, which means that they carry a distinct set of characteristics in our code. So every type of `Person` in our code, shares a common set of methods, properties, and constants, defined by the class `Person`.

## 1.2 Object Instantiation

So if the class defines the type then, you might be wondering, what is the object?

An object is basically the **instantiation** of a class. Instantiation is the process of creating an _instance_. It's what makes the class useful to our code. So to instantiate `Foo` is to create an instance of `Foo`. It's called an instance because it captures the state of `Foo` at that given point in time. So object _instances_ reflect state. State covers everything that changes the properties or values of an object.

The process of instantiation involves two basic steps.

1. Allocation of memory
2. Construction of the object

### 1.2.1 The new Keyword

Both of these steps are achieved by using the `new` keyword. So in order to instantiate the Person class we define above, we can do the following.

```PHP
    <?php
    $person = new Person;
```

`$person` is now an object of type `Person`. What we've done here is basically allocate new memory to store an instance of `Person` in PHP's object store and then construct the object instance in that memory.

```PHP
    <?php
    var_dump($person instanceof Person); // bool(true)
```

If you're wondering what construction entails, it's made up of a few simple rules.

- Find all parents of the class
- Inherit the methods/properties of those parents (_if any_)
- Assign the new object to the object store and return its number
- Call the class's magic \_\_construct method

We'll talk more about magic methods and inheritance rules later in this lesson. For now, what you need to know is that the construction of an object is made up of knowing all of its methods and properties so that when the object instance is called upon we know what behaviors and properties it carries and how to mutate them if necessary. This also gives us an idea of how much memory is needed to allocate for each instance of the class.

Because PHP does not store the object itself in a variable, the variable becomes an abstract container for the object. This prevents us from having to copy the object every time we pass it around to another function or scope. Instead, all we end up copying with the variable is an abstract value that points us to our object in the object store. Every time you create a new object in PHP (by using the `new` keyword), you cause PHP to allocate new memory for that object and PHP remembers where the memory is by assigning a unique number to each object in the object store. This number is all that's passed back to your variable. When there are no more variables using that number, PHP knows to clean up the object memory and remove it from the object store.

To test this let's take a look at what `var_dump` shows us when we do the following...

```PHP
    <?php
    $person1 = new Person;
    $person2 = new Person;
    $person3 = $person1;

    var_dump($person1, $person2, $person3);
```

The output generated by `var_dump` would look like this...

    object(Person)#1 (1) {
      ["age"]=>
      int(0)
    }
    object(Person)#2 (1) {
      ["age"]=>
      int(0)
    }
    object(Person)#1 (1) {
      ["age"]=>
      int(0)
    }

Notice `#1` next to the first `object(Person)` in the output. This is the unique number that points to our object, which the variable stores in order to know how to access the object's memory without copying the object around. Since `$person3` is just a copy of `$person1` they both share the same number.

To prove this let's change the property of `$person3`'s age to 5 and see how that affects `$person1`.

```PHP
    <?php
    $person3->grow(5);

    var_dump($person1, $person2, $person3);
```

Notice that now both `$person1` and `$person3` have the same value for `age` while `$person2` remains unaffected.

    object(Person)#1 (1) {
      ["age"]=>
      int(5)
    }
    object(Person)#2 (1) {
      ["age"]=>
      int(0)
    }
    object(Person)#1 (1) {
      ["age"]=>
      int(5)
    }

### 1.2.2 The clone Keyword

It's only when we use the `new` keyword that we allocate new memory and create a new object. When we use the `clone` keyword, however, the object is copied into a new part of memory, but it is not reconstructed from scratch. The difference is that `clone` won't call on the object constructor and copies the existing state of the cloned object over.

```PHP
    <?php
    $person4 = clone $person3;

    var_dump($person4);
```

You'll notice here that when we `clone` an object we are just creating a copy of that object into a new part of memory (so it gets a new number in the object store).

    object(Person)#3 (1) {
      ["age"]=>
      int(5)
    }

After we clone the object they become two separate instances, so changes to one instance no longer affects the other.

```PHP
    <?php
    $person4->grow(5);

    var_dump($person1, $person3, $person4);
```

You'll see no changes to `$person1` or `$person3` here...

    object(Person)#1 (1) {
      ["age"]=>
      int(5)
    }
    object(Person)#1 (1) {
      ["age"]=>
      int(5)
    }
    object(Person)#3 (1) {
      ["age"]=>
      int(10)
    }

## 1.3 Operators

Before we go one to learn more about methods, let's first explain how objects are operated on.

There are two types of operators we should know. Class operators and object operators. Class operators operate on a class whereas object operators operate on a given object instance. They are both binary operators, meaning they take on two operators (_a left-hand operand and a right-hand operand_). The left-hand operand of a class operator is the class name. Its right-hand operands can be either a static class method, a class constant, or a class variable. We'll learn more about these later in the lesson. The left-hand operand of an object operator is obviously the object instance itself and its right-hand operand can be either a property of the instance or a method of the instance.

### 1.3.1 Object Operator

The object operator is a dash `-`, followed by a greater-than sign `>`, like so: `->`

We saw this in earlier examples where we call on the `grow` method of the `Person` object.

To access the property of an instance you do the same. Let's take a look at an example...

```PHP
<?php
$person = new Person;
echo $person->age; // 0
```

In the example above we use the object operator (or instance operator) to access the public property of `age`, of the instance of `Person`, and print its value. As you can see `$person` (_our instance_) is on the left-hand side of the operator `->`, and `age` (_the instnace property_) is on the right-hand side of the operator. Together they make up the expression that gives us `0`.

### 1.3.2 Class Operator

The other kind of operator we haven't seen yet is a class operator, called _scope resolution operator_ or otherwise known as `PAAMAYIM NEKUDOTAYIM`, and is defined as two colons `::`.

It can be used to access constants, class variables, or static class methods. So basically anything that belongs to class itself, and not the object instance.

Here's an example using constants...

```PHP
<?php
class Person {
    const CHROMOSOMES = 46;
}

echo Person::CHROMOSOMES; // 46
```

As you can see the class name is on the left-hand side of the operator and the constant name is on the right-hand side.

## 1.4 Methods

Methods commonly make up the majority of most class definitions. We already know that they define behavior in an object instance. How we deal with each individual instance of the class itself is usually the focus of our method. What you want to consider is that the class name, along with the method name, usually make up a story. In that they tell us something about what the instance is doing at that time.

Let's consider our earlier example using the `Person` class and the `grow` method. The following code tells us that the person is _growing_, by a given number of years.

```PHP
<?php
class Person {
    public $age = 0;

    public function grow($years = 1) {
        $this->age += $years;
    }
}

$person = new Person;
$person->grow(20);
echo $person->age; // 20
```

The code beneath the class definition actually begins to read like a story. We created a **_new_** person. **_Grew_** them by 20 years and looked at their **_age_**.

### 1.4.1 Instance Methods

By now, you might now be wondering what is `$this` and what does it do? Since `grow` is what is considered an _instance_ method, it will always have access to the object instance. The object instance is available to every instance method through the pseudovariable `$this`. Pretty much all class methods are instance methods by default. So they're commonly just referred to as methods. The only methods that don't have access to the object instance are class methods, which we'll learn more about a little further ahead.

Since every instantiation of a class reserves its own memory, every property of that instance is retained in a distinct part of memory as well. So the only way to modify the property of that particular instance from inside of the method is to use `$this`. It's the same thing as simply copying the instance into the method by handing itself to the method as an argument.

Let's experiment!

```PHP
<?php
class Person {
    public $age = 0;

    public function grow($years = 1, $person) {
        $person->age += $years;
    }
}

$person = new Person;
$person->grow(20, $person);
echo $person->age;
```

This basically does the same exact thing as our earlier code using `$this`, except that instead of relying on the already populated instance variable inside the method (_which PHP makes conveniently available to us through `$this`_), we are handing a copy of that instance to the method through one of the method arguments and then modifying it through there instead. This is also the same thing as saying `$person->age += 5` from the global scope (_outside of the method_). We use `$this` inside of the method so that we don't have to keep handing each method back its instance. We know that PHP will always populate `$this` for us with the correct instance automatically inside of every instance method.

### 1.4.2 Static Methods

Static methods belong to the class and, unlike instance methods, they do not have access to the object instance (_i.e. `$this`_). They are defined by using the `static` keyword in their declaration.

Here's an example:

```PHP
<?php
class Person {

    public $age = 0;

    public function grow($years = 1) {
        $this->age += $years;
    }

    public static function speak() {
        echo "Hello PHP World!";
    }

}

Person::speak(); // Hello PHP World!
```

The `speak` method here is shared among all types of `Person`. Meaning, it is a characteristic of the class, and not necessarily a characteristic of the individual instances of that class. However, since we instantiate objects from a class you can also call on static methods through the object instance. However, you cannot go the other way around (_call the instance method on a class_).

So the following is also perfectly valid PHP code...

```PHP
<?php

$person = new Person;
$person::speak(); // Hello PHP World!
$person->speak(); // Hello PHP World!
```

You can also do the same from within the instance method...

```PHP
<?php
class Person {

    public $age = 0;

    public function grow($years = 1) {
        $this->age += $years;
    }

    public static function speak() {
        echo "Hello PHP World!";
    }

    public function says() {
        $this::speak();
    }

    public function saysThis() {
        $this->speak();
    }

}

$person = new Person;
$person->says(); // Hello PHP World!
$person->saysThis(); // Hello PHP World!
```

All of which is perfectly valid code.

Since classes are essentially meant to create a set of related behaviors and instances are meant to provide a meaningful state of those behaviors, static methods belong only to the class and have no access to the object instance even if they are called on by the object instance. They're merely global functions distinguished by a class name. They should typically only be used to describe behaviors related to the class that have no bearing on state (_i.e. they never require access to the instance anyway_).

### 1.4.3 Method Visibility

Methods can be given specific visibility limitations through what's called a _visibility specifier_. This is a declarative keyword that comes before the method signature. There are three kinds of visibility specifiers in PHP. They are: **public**, **protected**, and **private**.

#### 1.4.3.1 Public

All methods in a class are public by default. For backwards compatibility with older PHP 4 code, the visibility specifier is not actually required in the method signature. In PHP 4 there were no visibility specifiers and as such all methods are considered public. This remains the same in PHP 5.

So following code works exactly the same as our `Person` class definition given earlier in section [1.1](#11-class-definitions) of this lesson.

```PHP
    <?php
    class Person {
        public $age = 0;

        function grow($years = 1) {
            $this->age += $years;
        }
    }
```

Even without declaring `grow` as a public method, it is still considered public. This means that pretty much any part of our code has access to this method.

#### 1.4.3.2 Protected

Methods declared with the `protected` visibility specifier are only visible to that class and any classes that inherit from it. We'll get into inheritance rules in the next lesson.

So in the following example, we could not call the method `grow` on the object `$person` like we did earlier since the method here is declared `protected`.

```PHP
    <?php
    class Person {
        public $age = 0;

        protected function grow($years = 1) {
            $this->age += $years;
        }
    }

    $person = new Person;
    $person->grow();
```

Doing this would give us a fatal error similar to `Fatal error: Call to protected method Person::grow() from context '' in /tmp/Pid5D on line 11`, which just means that PHP can't access this method since it is _protected_ by the class `Person`. The only way we can access this method now is if we call it from within an instance method of the class `Person`, which is commonly referred to as being in _object context_. Whereas here our context is considered global or anonymous.

So if we did the following instead we are able to access the `grow` method again...

```PHP
    <?php
    class Person {
        public $age = 0;

        protected function grow($years = 1) {
            $this->age += $years;
        }

        public function growth($years = 1) {
            $this->grow($years);
        }
    }

    $person = new Person;
    $person->growth();
```

In this example the `public` method `growth` is now calling on the `protected` method `grow` for us, from inside of _object context_, which is necessary since only the object instance can see and gain access to that method.

#### 1.4.3.3 Private

Methods declared with the `private` visibility specifier are only visible to that class and that class alone.

So modifying the example above to declare `grow` as a `private` method would have the same net effect. The only difference is that any children of this class cannot access this method. We'll talk more about inheritance rules in the next lesson.

### 1.4.4 Final Methods

Methods declared using the `final` keyword end the inheritance chain. This just means that no children of that class may override this method. This will become more meaningful when we get into inheritance. For now just remember that `final` is a declarative keyword for methods that makes them **_final_**.

### 1.4.5 Magic Methods

Magic methods are methods that PHP will automatically call on when your object comes into certain kinds of interactions throughout your code. This is normally referred to as _overloading_. It just means that one behavior gets magically overloaded by a different behavior. So the definition of a magic method in your class creates this overloaded behavior and PHP handles the behavior change for you automatically. There are a total of 15 magic methods as of PHP 5.6.0, which your classes may define.

All magic methods are prefixed with two underscores. Here are a list of all the existing magic methods in PHP and what they do...

| Method         | Description                                                                                                                                                                                                                                                            |
| -------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| \_\_construct  | This method is called immediately after the object is instantiationed using the new keyword. It takes whatever arguments are passed into the object construct when it is instantiated and cannot return any value.                                                     |
| \_\_desctruct  | This method is called when the object is about to be destroyed (_removed from the object store_).                                                                                                                                                                      |
| \_\_get        | This method is called when an inaccessible property of the object is read and takes one argument, which is the name of the property begin accessed.                                                                                                                    |
| \_\_set        | This method is called when an inaccessible property of the object is assigned a value and takes two arguments, the name of the property being accessed and the value being assigned.                                                                                   |
| \_\_isset      | This method is called whenever `isset()` is used on an inaccessible property of the object.                                                                                                                                                                            |
| \_\_unset      | This method is called whenever `unset()` is called on an inaccessible property of the object.                                                                                                                                                                          |
| \_\_call       | This method is called whenever an inaccessible method is called on the object instance. It takes two arguments, the method name that was called, and an array of arguments that were passed to that method.                                                            |
| \_\_callStatic | This method behaves the same as `__call` except that it only applies to when the method is called statically.                                                                                                                                                          |
| \_\_toString   | This method is called whenever the object is put into string context. It takes no arguments, but is expected to return a string. For example `echo new Person` would invoke the `__toString` method if `Person` implements it. Otherwise PHP would give a Fatal error. |
| \_\_sleep      | This method is called whenever the object is serialized using the `serialize()` function. It takes no arguments, but is expected to return an array of variable names that are to be serialized from the object. If no names are returned then `NULL` is serialized.   |
| \_\_wakeup     | This method is called whenever the object is unseriailized using the `unserialize()` function.                                                                                                                                                                         |
| \_\_invoke     | This method is called if the object is used as a function. For example,`$person = new Person; $person();` would call the on `__invoke` method if it has one.                                                                                                           |
| \_\_set_state  | This method is called when the object is used in `var_export()`. The method may only be declared as static and takes one argument as an array of properties to export e.g. `array(propertyName => value)`. The method is expected to return an object.                 |
| \_\_clone      | This method is called when an object is cloned using the `clone` keyword.                                                                                                                                                                                              |
| \_\_debugInfo  | This method is called when an object is put in `var_dump()` and is expected to return an array of property names to values as in `array(propertyName => value)` which will be shown in the `var_dump` output.                                                          |

The two most common magic methods you will encounter in most PHP object oriented code are `__construct` and `__destruct`.

The `__construct` can be used to setup your object once it's instantiated. This is a good place for initializing properties and setup the default state of the object. To give an example let's expand upon our `Person` class definition from earlier and give it some more realistic properties.

```PHP
<?php
class Person {
    public $name, $age, $occupation;

    public function __construct($name, $age, $occupation) {
        $this->name       = $name;
        $this->age        = $age;
        $this->occupation = $occupation;
    }

    public function speak() {
        return "Bob says: I'm $this->age years old and am a $this->occupation.";
    }
}

$person = new Person('Bob', 21, 'Software Engineer');
echo $person->speak();
```

The above example will output the following:

    Bob says: I'm 21 years old and am a Software Engineer.

However, people don't typically have an age property. They usually have a date of birth and that date of birth is in turn used to produce their age. So to make Bob more realistic let's create a person more human characteristics.

```PHP
<?php
class Person {
    public $name, $dob, $gender;

    public function __construct($name, DateTime $dob, $gender) {
        $this->name   = $name;
        $this->dob    = $dob;
        $this->gender = $gender;
    }

    public function age() {
        return $this->dob->diff(new DateTime)->y;
    }
}

$person = new Person('Bob', new DateTime('12/1/1984'), 'male');
echo "$person->name is a {$person->age()} year old $person->gender.";
```

The above example would give us...

    Bob is a 29 year old male.

However, let's say that we wanted to further validate certain properties before we assign them to our object. For example, it stands to reason that we would only want the `gender` property to have either a value of _male_ or _female_. We can do this in our constructor as follows...

```PHP
<?php
class Person {
    public $name, $dob, $gender;

    public function __construct($name, DateTime $dob, $gender) {
        $this->name   = $name;
        $this->dob    = $dob;
        if ($gender !== 'male' && $gender !== 'female') {
            echo "Invalid gender supplied to Person! Assuming male...";
            $gender = 'male';
        }
        $this->gender = $gender;
    }

    public function age() {
        return $this->dob->diff(new DateTime)->y;
    }
}
```

So now if anything other than the expected male or female value is provided as the gender argument to the constructor, we get a message that lets us know the value is unexpected and the default value is set. This solves the problem of passing the wrong value to the construct, but it doesn't change anything about assigning the value of the property directly. So the following code still works...

```PHP
<?php
$person = new Person('Bob', new DateTime('12/1/1984'), 'male');
$person->gender = 'something else';
echo "$person->name is a {$person->age()} year old $person->gender.";
// Bob is a 29 year old something else.
```

Since `gender` is a public property any part of your code is allowed to read/modify its value. To change this behavior we can rely on the `__set` and `__get` magic methods to control the validation of the property.

```PHP
<?php
class Person {
    public $name, $dob;
    private $gender = 'male';

    public function __construct($name, DateTime $dob, $gender) {
        $this->name   = $name;
        $this->dob    = $dob;
        $this->setGender($gender);
    }

    public function __get($name) {
        if ($name === 'gender') {
            return $this->gender;
        }
    }

    public function __set($name, $value) {
        if ($name === 'gender') {
            $this->setGender($value);
        }
    }

    private function setGender($gender) {
        if ($this->validateGender($gender)) {
            $this->gender = $gender;
        } else {
           /* handle error case here */
        }
    }

    private function validateGender($gender) {
        $gender = strtolower($gender);
        if ($gender !== 'male' && $gender !== 'female') {
            return false;
        }
        return true;
    }

    public function age() {
        return $this->dob->diff(new DateTime)->y;
    }
}

$person = new Person('Bob', new DateTime('12/1/1984'), 'male');
$person->gender = 'something else';
echo "$person->name is a {$person->age()} year old $person->gender.";
// Bob is a 29 year old male.
```

What we've done here is separate the logic of validating and assigning the gender to the `Person` object by making the `gender` property `private`, which makes it inaccessible to anything outside of object context. So when you attempt to assign `$person->gender` a value, you instead trigger the overloaded magic method `__set` which calls on `Person::setGender()` that calls on `Person::validateGender()` to make sure the value you are trying to assign is a valid gender value, and if so it assigns it, otherwise the default value remains intact. Because `gender` is a `private` property, when you try to read from it the magic `__set` method is triggered, and its value is conveniently returned. So to the caller, using `$person->gender` appears to behave normally with the exception that is using the overloaded behaviors of reading and assignment to prevent an unacceptable value from populating the property.

## 1.5 Properties

We've already learned quite a bit about properties, but let's dive a little deeper.

Properties can belong to either a class or an instance of that class, but not both. Properties that belong to the class are commonly referred to as class variables.

### 1.5.1 Class Variables

Properties that belong to the instance are commonly referred to as instance variables. The difference is that class variables are static, and can only be initialized at compile time (_i.e. in the class definition itself_). Both class and instance variables may be assigned any of the visibility specifiers: `public`, `protected`, and `private`. Class variables are declared in the class using the `static` keyword.

Here's an example.

```PHP
<?php
class Person {
    public static $scientificName = 'Homo sapien';
}

echo "A person is also known as a " . Person::$scientificName . "!";
```

This would give us the following output...

    A person is also known as a Homo sapien!

Since class variables are shared across the entire class they are also accessible by the instance methods using the `self` or `static` keyword.

```PHP
<?php
class Person {
    public static $scientificName = 'Homo sapien';

    public function alias() {
        return static::$scientificName;
    }
}

$person = new Person;
echo "A person is also known as a " . $person->alias() . "!";
```

This would give us the same output of `A person is also known as a Homo sapien!` as above.

### 1.5.2 Instance Variables

We've already seen plenty of examples of instance variables at this point. Since an instance isn't required to initialize its properties, any instance can initialize an instance variable as public at any time.

```PHP
<?php
class Person { // An empty class with no initialized properties
}

$person = new Person; // a new instance
// initializing a public property not in the class definition
$person->foo = 'bar';

var_dump($person);
```

This gives us...

    object(Person)#1 (1) {
      ["foo"]=>
      string(3) "bar"
    }

So instance variables that are public can be defined at any point, but class variables can only be defined inside the class definition.

### 1.5.3 Property Visibility

Just like methods, properties can be declared with visibility specifiers in the class definition. We saw an example of this in the magic method section using `__get` and `__set`, for example.

#### 1.5.3.1 Public

A property with a `public` visibility specifier may be accessed from any part of your code. Unlike, methods, however, the `public` visibility specifier is required in the class definition when initializing a property, whether it is a class variable or instance variable.

So the following is not valid in PHP:

```PHP
<?php
class Person {
     $age;
}
```

This must be:

```PHP
<?php
class Person {
     public $age;
}
```

#### 1.5.3.2 Protected

Just like with methods, `protected` properties can only be accessed by the class declaring them or any of its children.

#### 1.5.3.3 Private

Similarly, like methods, `private` properties can only be accessed by the class declaring them and no other classes.

## 1.6 Constants

Constants belong to the class and are always public. They can only be declared inside the class definition using the `const` keyword. Remember that constants are only allowed to have scalar values in PHP.

Constants can be accessed from within class methods using the `static` or `self` keyword. They can also be accessed by the object instance by using the _scope resolution operator_ `::` followed by the constant name. So all of the following examples are valid.

```PHP
<?php
class Person {
    const CHROMOSOMES = 46;

    public function getChromosomes() {
        return static::CHROMOSOMES;
    }

    public function getOtherChromosomes() {
        return self::CHROMOSOMES;
    }

    public function getThisChromosomes() {
        return $this::CHROMOSOMES;
    }
}

$person = new Person;

var_dump($person::CHROMOSOMES, Person::CHROMOSOMES, $person->getChromosomes(),
         $person->getOtherChromosomes(), $person->getThisChromosomes()
);
```

The above all output `int(46)`.
