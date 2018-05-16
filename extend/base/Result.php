<?php
/**
 * [Result.php]
 * Auther: Charlie chai <take3812@gmail.com>
 * Date: 2016/10/21 17:08
 */
namespace base;

/**
 * Class Result
 * @package base
 */

class Result{

	private $code = NULL;

	private $msg = "";

	private $result = [];

	private $error = [];

    public  $fn;

	/**
	 * Result constructor.
	 * * @param int $code
	 * @param string $msg
	 * @param array $result
	 *
	 */
	public function __construct(int $code, string $msg, array $result= [], string $error = NULL){
		$this->code = $code;
		$this->msg = $msg;
		$this->result = $result;
		$this->error = $error;
	}

	public static function newResult(int $code, string $msg, array $result= [], string $error = NULL){
        return new Result($code, $msg, $result, $error);
    }

	/**
	 * @return int
	 */
	public function getCode(): int{
		return $this->code;
	}

	/**
	 * @param int $code
	 */
	public function setCode(int $code){
		$this->code = $code;
        return $this;
	}

	/**
	 * @return string
	 */
	public function getMsg(): string{
		return $this->msg;
	}

	/**
	 * @param string $msg
	 */
	public function setMsg(string $msg){
		$this->msg = $msg;
        return $this;
	}

	/**
	 * @return array
	 */
	public function getResult(): array{
		return $this->result;
	}

	/**
	 * @param array $result
	 */
	public function setResult(array $result){
		$this->result = $result;
        return $this;
	}

    /**
     * @return mixed
     */
    public function getFn(){
        return $this->fn;
    }

    /**
     * @param mixed $fn
     */
    public function setFn($fn){
        $this->fn = $fn;
        return $this;
    }

    /**
     * toString()
     * @param string $type  json/xml/
     * @return string
     */
	public function toString(string $type="json"):string{
	    switch($type){
            case 'json':
                return json_encode(['code' => $this->code, 'msg' => $this->msg, 'result' => $this->result]);
            break;
            case 'xml':
                break;
            default:
        }
	}

    /**
     * toJson()
     * @return string
     */
	public function toJson():string{
	    return $this->toString('json');
    }

    /**
     * return()
     * @param string $type
     */
	public function return(string $type = 'json'){
        echo $this->toString($type);
    }

    /**
     * isOk()
     * @return bool
     */
    public function isOk():bool{
        if(empty($this->code)){
            return false;
        }else{
            return (bool)$this->code;
        }
    }

    /**
     * success()
     * @param int           $state
     * @param callable|NULL $fn
     * @return $this
     */
    public function success(int $state, callable $fn = NULL){
        assert((bool)$this->code);
        $state && (!empty($fn) || $fn->call());
        return $this;
    }

    /**
     * fail()
     * @param int      $state
     * @param callable $fn
     * @return $this
     */
    public function fail(int $state, callable $fn){
        assert(!(bool)$this->code);
        !$state && $fn->call();
        return $this;
    }

    /**
     * output()
     */
    public function output(){
        echo json_encode($this->result);
    }

    /**
     * assert()
     * @param \bool[] ...$args
     * @return $this
     */
    public function assert(bool ...$args){
        foreach($args as $k => $v){
            if(!$v){
                $this->code = State::FAIL;
                break;
            }
        }
        return $this;
    }

    public function add($elem){
        $this->result[] = $elem;
    }

}

/**
 * Local variables:
 * tab-width: 4
 * EOF
 */