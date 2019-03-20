<?php
/**
 * Created by PhpStorm.
 * User: z_kurtev
 * Date: 2019-02-06
 * Time: 7:25 PM
 */

class DataStore
{
    protected $firstName;
    protected $lastName;
    protected $age;

    public function getConnection()
    {
        if (!isset($link)) {
            static $link = NULL;
        }

        if ($link === NULL) {
            $link = mysqli_connect('localhost:3307', 'root', '', 'juliendb');
        }
        return $link;
    }

    public function closeConnection()
    {
        if (!isset($link)) {
            static $link = NULL;
            return FALSE;
        } else {
            mysqli_close($link);
            return TRUE;
        }
    }

    function getCustomers(array $where = array())
    {
        $query = 'SELECT `age`,`first_name`,`last_name` FROM `customers`';
        if ($where) {
            $query .= ' WHERE ';
            foreach ($where as $column => $value) {
                $query .= $column . ' = ' . "'" . $value . "'";
            }

        }
        $link = getConnection();
        $result = mysqli_query($link, $query);
        return mysqli_fetch_all($result);
    }

$myArray = getCustomers(array('id' => '1'));

closeConnection();

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lasttName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }


}