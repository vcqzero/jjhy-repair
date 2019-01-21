<?php
namespace App\Filter;

use Zend\InputFilter\InputFilter;

abstract class MyInputFilter
{
    private $isValid  = false;
    private $filteredValues = [];
    private $invalidMessage;
    
    abstract function getRules();
    /**
     * @return the $invalidMessage
     */
    public function getInvalidMessage()
    {
        return $this->invalidMessage;
    }
    
    /**
    * 执行验证和过滤
    * 
    * @param  array $formConfig 验证时所用规则
    * @param  array $values 待验证或过滤数据
    * @param  bool  $deleteEmpty 是否删除表单中 value='' 的数据
    * @return        
    */
    private function excute($values)
    {
        //获取$InputFilter并设置好验证规则
        $InputFilter = new InputFilter();
        $rules       = $this->getRules();
        foreach ($rules as $key=>$rule)
        {
            $InputFilter ->add($rule);
        }
        //设置待验证数据
        $InputFilter->setData($values);
        //获取验证结果
        //is valid
        $this->isValid  = $InputFilter->isValid();
        $this->setInvalidMessage($InputFilter);
        
        //values
        $values         = $InputFilter->getValues();
        $values         = $this->deleteNull($values);
        $this->filteredValues = $values;
    }
    
    /**
    * 过滤数据
    * 
    * @param  array $values
    * @param  array $rules
    * @return array 获取过滤之后的数据      
    */
    public function filter($values)
    {
        $this->excute($values);
        return $this->filteredValues;
    }
    
    /**
    * 删除表单中值为null的值，
    * 当过滤规则中有字段但是过滤数据没有字段时，过滤之后，
    * 这些字段就会赋值为null
    * 
    * @param array $formData 
    * @return array        
    */
    private function deleteNull($formData)
    {
        foreach ($formData as $key=>$val)
        {
            if ($val === null) 
            {
                unset($formData[$key]);
            }
        }
        return $formData;
    }
    
    /**
     * 删除表单中值为空的字段
     *
     * @param array $formData
     * @return array
     */
    private function deleteEmpty($values)
    {
        foreach ($values as $key=>$val)
        {
            if ($val == '' && $val !== 0 && $val !== '0') 
            {
                unset($values[$key]);
            }
        }
        return $values;
    }
    
    /**
     * 将未通过验证的结果信息拼接为一个字符串
     * 如果没有错误信息则返回信息经过验证了
     *
     * @param  object $inputVaild
     * @return string $message
     */
    private function setInvalidMessage(InputFilter $inputFilter)
    {
        $message = '';
        foreach ($inputFilter->getInvalidInput() as $key=>$error)
        {
            $error_message = $error->getMessages();
            $error_message = 'INVALID NAME IS ' . $key . ' MESSAGE IS ' . implode('|', $error_message);
            $message = $error_message . $message;
        }
        if (empty($message)) {
            $this->invalidMessage = '';
        } else {
            $this->invalidMessage = 'FormData is invalid->' . $message;
        }
    }
}