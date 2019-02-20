<?php
/**
 * Created by PhpStorm.
 * User: ACAY
 * Date: 2019-02-06
 * Time: 7:24 PM
 */

class DataStore
{
    protected $firstName;
    protected $lastName;
    protected $age;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return DataStore
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return DataStore
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return DataStore
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }
}