<?php
    class User{
        //$username, $encryptedPass, $email, $emailEmergency, $name, $lastname, $role
        protected $name;
        protected $lastname;
        protected $username;
        protected $password;
        protected $email;
        protected $officeNumber;
        protected $phoneNumber;
        protected $profilePicture;
        protected $faculty;
        protected $role;
        
        public function __construct($name, $lastname, $username, $password, $email, $officeNumber, $phoneNumber, $profilePicture, $faculty, $role){
            $this->name = $name;
            $this->lastname = $lastname;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->officeNumber = $officeNumber;
            $this->phoneNumber = $phoneNumber;
            $this->profilePicture = $profilePicture;
            $this->faculty = $faculty;
            $this->role = $role;
        }


        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of officeNumber
         */ 
        public function getOfficeNumber()
        {
                return $this->officeNumber;
        }

        /**
         * Set the value of officeNumber
         *
         * @return  self
         */ 
        public function setOfficeNumber($officeNumber)
        {
                $this->officeNumber = $officeNumber;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         *
         * @return  self
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

        /**
         * Get the value of profilePicture
         */ 
        public function getProfilePicture()
        {
                return $this->profilePicture;
        }

        /**
         * Set the value of profilePicture
         *
         * @return  self
         */ 
        public function setProfilePicture($profilePicture)
        {
                $this->profilePicture = $profilePicture;

                return $this;
        }

        /**
         * Get the value of faculty
         */ 
        public function getFaculty()
        {
                return $this->faculty;
        }

        /**
         * Set the value of faculty
         *
         * @return  self
         */ 
        public function setFaculty($faculty)
        {
                $this->faculty = $faculty;

                return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }
    }


        
?>