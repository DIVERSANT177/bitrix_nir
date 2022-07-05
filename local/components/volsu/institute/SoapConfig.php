<?php namespace Volsu\Soap;
ini_set("soap.wsdl_cache_enabled", "0");
 
class SoapConfig {
    /**
     * @var string $url wsdl url
     */
    private $url;
    /**
     * @var string $login client login
     */
    private $login;
    /**
     * @var string $password client password
     */
    private $password;
    /**
     * @var bool $debug debug mode (default false)
     */
    private $debug = false;

    public $skipError = false;

    /**
     * SoapConfig constructor.
     * @param $url
     * @param $login
     * @param $password
     */
    public function __construct($url, $login, $password) {
        $this->url = $url;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Return wsdl url
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Return client login
     * @return string $login
     */
    public function getLogin()
    {
        return $this->login;   
    }

	public function getSecondLogin()
	{
		return $this->login;
	}

    /**
     * Return client password
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

	public function getSecondPassword()
	{
		return $this->password;
	}

    /**
     * Set debug mode to true
     * @param bool $mode
     */
    public function setDebug($mode = true)
    {
        $this->debug = $mode;
    }

    /**
     * Return debug mode
     * @return bool
     */
    public function getDebug()
    {
        return $this->debug;
    }
}