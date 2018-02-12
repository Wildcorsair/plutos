<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 2/12/18
 * Time: 10:15 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ORM\Entity;
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=30)
     *
     * @Assert\NotBlank()
     * @var string
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=30)
     *
     * @Assert\NotBlank()
     * @var string
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\NotBlank()
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\NotBlank()
     * @var string
     */
    protected $password;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}