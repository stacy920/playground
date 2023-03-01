<?php

class Person{
    protected $name;
    protected $gender;
    protected $birthday;
    
    public function setName($newName){
        $this->name = $newName;
    }
    public function getName(){
        return $this->name;
    }
    public function setGender($newGender){
        $this->gender = $newGender;
    }
    public function getGender(){
        return $this->gender;
    }
    public function setBirthday($newBirthday){
        $this->birthday = $newBirthday;
    }
    public function getBirthday(){
        return $this->birthday;
    }
}

//interface

class Account extends Person{
    protected $account;
    protected $mail;
    protected $note;
    
    public function setAccount($newAccount){
        $this->account = $newAccount;
    }
    public function getAccount(){
        return $this->account;
    }
    public function setMail($newMail){
        $this->mail = $newMail;
    }
    public function getMail(){
        return $this->mail;
    }
    public function setNote($newNote){
        $this->note = $newNote;
    }
    public function getNote(){
        return $this->note;
    }
}
?>
