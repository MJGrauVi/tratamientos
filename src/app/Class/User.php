<?php

namespace App\Class;

use App\Enum\UserType;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class User
{
    private UuidInterface $uuid;
    private string $username;
    private string $email;
    private string $password;
    private UserType $type;
    private DateTime $birthdate;
    private float $viewedHours;

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(string $username, string $email, string $password)
    {
        $this->uuid= Uuid::uuid4();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }


    public function getUuid():string{
        return $this->uuid;

    }


    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getType(): UserType
    {
        return $this->type;
    }

    public function isAdmin():bool{

        if ($this->type===UserType::ADMIN){
            return true;
        }else{
            return false;
        }
    }

    public function setType(UserType $type): User
    {
        $this->type = $type;
        return $this;
    }

    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(DateTime $birthdate): User
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getViewedHours(): float
    {
        return $this->viewedHours;
    }

    public function setViewedHours(float $viewedHours): User
    {
        $this->viewedHours = $viewedHours;
        return $this;
    }

    public static function createUserFromArray(array $userData):User{

        $usuario=new User(
            $userData['username'],
            $userData['email'],
            $userData['password']
        );
        $usuario->setBirthdate(DateTime::createFromFormat('Y-m-d',$userData['birthdate']));
        $usuario->setType(UserType::createFromString($userData['type']));

        return $usuario;

    }

    public static function validateUserCreation(array $userData):User|array{
       try{
           v::key('email',v::email())
               ->key('username',v::stringType()->length(3,64))
               ->key('password',v::stringType()->length(3,15))
               ->key('birthdate',v::date('Y-m-d'))
               ->key('type',v::in(['admin','normal','publicidad']))
               ->assert($userData);

       }catch (NestedValidationException $errores){
           return $errores->getMessages();
       }

       //Creacion de un usuario
        return User::createUserFromArray($userData);



    }

    public function toArray(){
        return [
            "username"=>$this->username,
            "password"=>$this->password,
            "email"=>$this->email
        ];
    }



}