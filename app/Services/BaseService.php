<?php


namespace App\Services;


class BaseService
{
    /**
     * @var array
     */
    private $_data = [];

    /**
     * @param array|null $data
     * @return $this
     */
    public function setData(?array $data = [])
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * @param bool $success
     * @return $this
     */
    public function success($success = true)
    {
        $this->_data = array_merge($this->_data, ['success'=>$success]);
        return $this;
    }

    /**
     * @param string|array $message
     * @return $this
     */
    public function message($message)
    {
        $this->_data = array_merge($this->_data, ['message'=>$message]);
        return $this;
    }

    /**
     * @return $this
     */
    public function saveMessage()
    {
        $message = [
            'title'=>trans('form.message.successTitle'),
            'text'=>trans('form.message.successText')
        ];

        $this->_data = array_merge($this->_data, ['message'=>$message]);
        return $this;
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->_data;
    }


}