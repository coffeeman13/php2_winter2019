<?php
/**
 * Created by PhpStorm.
 * User: z_hexiao
 * Date: 2019-02-06
 * Time: 7:19 PM
 */

class dataStore
{
    protected $firstName;
    protected $lastName;
    protected $age;
    protected $link;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return dataStore
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
     * @param mixed $lastName
     * @return dataStore
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
    }



    public function getConnection()
    {
        if (!isset($this->link)) {
            $this->link = NULL;
        }

        if ($link === NULL) {
            $link = mysqli_connect('localhost:3307', 'lightmvcuser', 'testpass', 'lightmvctestdb');
        }
        return $link;
    }

    public function closeConnection()
    {
        if (!isset($this->link)) {
            $this->link = NULL;
            return FALSE;
        } else {
            mysqli_close($this->link);
            return TRUE;
        }
    }

    public function getQuote()
    {
        return "'";
    }

// SELECT `id`,`firstname`,`lastname` FROM `customers` WHERE x=y
// $where = [key = column name, value = data]
// $andOr = AND | OR
    public function getCustomers(array $where = array(), $andOr = 'AND')
    {
        $this->$query = 'SELECT `id`,`firstname`,`lastname` FROM `users`';
        if ($where) {
            $query .= ' WHERE ';
            foreach ($where as $column => $value) {
                $query .= $column . ' = ' . getQuote() . $value . getQuote() . ' ' . $andOr;
            }
            $query = substr($query, 0, -(strlen($andOr)));
        }
        $this->link = getConnection();
        $thsi->result = mysqli_query($this->link, $this->query);
        return mysqli_fetch_all($this->result);
    }

        $myArray = getCustomers();

        closeConnection();
}