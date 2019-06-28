<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Client
{
    /**
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/[0-9]{9}/",
     *     message="Telefon musí obsahovat 9 čísel bez mezer"
     * )
     */

    protected $phone;

    /**
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^\+[0-9]{1,4}/",
     *     message="Kód země musí začínat + a pokračovat jedním až čtyřmi čísly"
     * )
     *
     */
    protected $code;

    /**
     * @Assert\NotBlank
     */
    protected $firstname;

    /**
     * @Assert\NotBlank
     */
    protected $lastname;

    /**
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/[0-9]{1,10}/",
     *     message="Provolané minuty musí být čislo"
     * )
     *
     */
    protected $minutesCalled;


    /**
     * @Assert\NotBlank
     */
    protected $agree;

    public function getPhone()
    {
        return $this->phone;
    }

    public function getFormatedPhone()
    {
        return $this->getCode() . " " . chunk_split($this->phone, 3, ' ');
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getMinutesCalled()
    {
        return $this->minutesCalled;
    }

    public function setMinutesCalled($minutesCalled)
    {
        $this->minutesCalled = $minutesCalled;
    }

    public function getAgree()
    {
        return $this->agree;
    }

    public function setAgree($agree)
    {
        $this->agree = $agree;
    }

    public function save() {

        $filename = $this->getFirstname() . "." . $this->getLastname();
        if(file_exists ( $newFile = dirname(__FILE__) . "/../../public/contacts/" . $filename . ".txt" )) {
            $count = 1;
            while(file_exists ( $newFile = dirname(__FILE__) . "/../../public/contacts/"  . $filename . "-" . $count . ".txt" )) {
                $count ++;
            }
        }
        $handle = fopen($newFile, "w+");
        fwrite (  $handle , $this->getFirstname() . "\t" . $this->getLastname() . "\t" . $this->getFormatedPhone() . "\t" . $this->getMinutesCalled() . "\t" . $this->getAgree() );
        fclose($handle);

        return true;
    }

}

?>